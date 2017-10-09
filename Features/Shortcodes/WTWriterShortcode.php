<?php
/**
 * Words Tree Writer Shortcode
 *
 * Globals Used:
 *
 * - $wt_theme_dir
 * - $terms
 * - $posts
 * - $breadcrumb
 * - $chapter
 *
 *
 * @author Savio Resende <savio@savioresende.com.br>
 */

namespace Features\Shortcodes;

use Repositories\Books;
use Repositories\Interfaces\CollectionInterface;
use Repositories\Interfaces\RepositoryInterface;

global $wt_theme_dir;
global $terms;
global $posts;
global $breadcrumb;
global $chapter;

$breadcrumb = [];

class WTWriterShortcode implements Interfaces\WTShortcodeInterface
{
    protected $statement_cache = [];

    // templates

    protected $summary_template = "templates/writer/summary.php";

    protected $terms_summary_template = "templates/writer/terms_summary.php";

    protected $editor_template = "templates/writer/writer.php";

    protected $chapter_template = "templates/writer/partials/chapter.php";

    protected $term_template = "templates/writer/partials/term.php";

    protected $breadcrumb_template = "templates/writer/partials/breadcrumb.php";

    // --


    /**
     * This keeps
     *
     * @var RepositoryInterface
     */
    private $main_repository;

    /**
     * This attribute keeps the GET request params
     *
     * @var
     */
    protected $get_request;

    public function __construct()
    {
        $this->main_repository = new Books();
    }

    /**
     * Receive the request
     *
     * @return void
     */
    public function run()
    {
        if (
            !empty($_GET)
            && isset($_GET['action'])
        ) {

            $this->get_request = $_GET;

            $action = sanitize_text_field($this->get_request['action']);

            switch ($action) {

                case 'search-chapters':

                    $this->prepareBreacrumb($action);

                    $this->doAction($action);

                    break;

                case 'edit-chapter':

                    $this->prepareBreacrumb($action);

                    $this->doAction($action);

                    break;

                default:

                    $this->returnTemplate('summary_template');

                    break;

            }

        } else {

            $this->doAction("search-books");

        }

    }

    /**
     * Require the template. This method is important to handle in a central place
     * the global wt_theme_dir.
     *
     * @param string $template
     * @throws \Exception
     * @return void
     */
    public function returnTemplate(string $template)
    {
        global $wt_theme_dir;

        if (!isset($this->{$template}))
            throw new \Exception("Invalid template.");

        require $wt_theme_dir . $this->{$template};
    }

    /**
     * Run the procedure according to the Rule on the self::start();
     *
     * @param string $action
     * @param array $args
     * @return void
     */
    public function doAction(string $action)
    {

        switch ($action) {

            case "search-books":
                $this->searchBooks();
                break;

            case "search-chapters":
                $this->searchChapters();
                break;

            case "edit-chapter":
                $this->editChapter();
                break;

            case "persist-book":
                break;

            case "persist-chapter":
                break;

            case "delete-book":
                break;

            case "delete-chapter":
                break;

        }

    }

    /**
     * Search by Books Taxonomy and print the summary template
     *
     * @param array $args
     * @return void
     */
    private function searchBooks()
    {
        global $terms;

        $statement = [
            'taxonomy' => 'book',
            'order'    => 'ASC',
            'parent'   => 0,
            'user_id'  => get_current_user_id()
        ];

        $terms = $this->executeSearchOnMainRepository($statement);

        $this->returnTemplate('terms_summary_template');

    }

    /**
     * Search by Books Chapters and print the summary template
     *
     * @param array $args
     * @return void
     */
    private function searchChapters()
    {
        global $posts;

        if( !isset($this->get_request['book']) )
            throw new \Exception("Invalid Book ID!");

        $book_id = sanitize_text_field($this->get_request['book']);

        $statement = [
            'post_type' => 'post',
            'posts_per_page' => '10',
            'author' => get_current_user_id(),
            'order_by' => 'date',
            'order' => 'DESC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'book',
                    'field' => 'term_id',
                    'terms' => $book_id
                )
            )
        ];

        $posts = $this->executeSearchOnMainRepository($statement);

        $this->returnTemplate('summary_template');
    }

    /**
     * Search the current Chapter and call the editor template.
     *
     * @return void
     */
    private function editChapter()
    {
        global $chapter;

        $chapters_collection = $this->placeChapterSearchForEdition();

        $chapter = $chapters_collection->current();

        $this->returnTemplate('editor_template');
    }

    /**
     * Place the search for the edition of the chapter.
     *
     * @return CollectionInterface
     */
    private function placeChapterSearchForEdition()
    {
        $chapter_id = sanitize_text_field($this->get_request['chapter']);

        $statement = [
            'id' => $chapter_id,
            'post_type' => 'post',
            'posts_per_page' => '1',
            'author' => get_current_user_id(),
            'order_by' => 'date',
            'order' => 'DESC'
        ];

        return $this->executeSearchOnMainRepository($statement);
    }

    /**
     * This method executes the prepared search on this main Repository
     *
     * @param array $statement
     * @return CollectionInterface
     */
    private function executeSearchOnMainRepository( array $statement ) : CollectionInterface
    {
        $key = md5(json_encode($statement));

        if( !isset($this->statement_cache[ $key ]) )
            $this->statement_cache[$key] = $this->main_repository->search($statement);

        return $this->statement_cache[ $key ];
    }

    /**
     * Prepare the breadcrumbs according to the $action
     *
     * @param string $action
     * @return void
     */
    private function prepareBreacrumb(string $action)
    {
        global $breadcrumb,
               $wp;

        switch( $action ){

            case 'search-chapters':

                $books_list_url = home_url(add_query_arg([],$wp->request));

                $book_id = sanitize_text_field($this->get_request['book']);

                // TODO: centralize the place to get terms
                $book_object = get_terms([
                    'id' => $book_id,
                    'taxonomy' => 'book',
                    'user_id' => get_current_user_id(),
                    'parent' => 0
                ]);

                if( !reset($book_object) )
                    throw new \Exception("Book not found!");

                $book_object = reset($book_object);

                array_push($breadcrumb, [
                    'value' => 'Books',
                    'link' => $books_list_url
                ]);

                array_push($breadcrumb, [
                    'value' => $book_object->name . '\'s Chapters',
                    'link' => ''
                ]);

                break;

            case 'edit-chapter':

                $books_list_url = home_url(add_query_arg([],$wp->request));

                $chapters_collection = $this->placeChapterSearchForEdition();

                $book_array = wp_get_post_terms(
                    $chapters_collection->current()->id,
                    'book',
                    [
                        'parent' => 0
                    ]
                );

                $book_object = reset($book_array);

                if( !$book_object )
                    throw new \Exception("Book not found!");

                array_push($breadcrumb, [
                    'value' => 'Books',
                    'link' => $books_list_url
                ]);

                $chapters_list_url = home_url(add_query_arg([
                    'action' => 'search-chapters',
                    'book' => $book_object->term_id
                ],$wp->request));

                array_push($breadcrumb, [
                    'value' => $book_object->name . '\'s Chapters',
                    'link' => $chapters_list_url
                ]);

                array_push($breadcrumb, [
                    'value' => $chapters_collection->current()->post_title,
                    'link' => ''
                ]);

                break;

        }
    }

}