<?php
/**
 * Words Tree Writer Shortcode
 *
 * @author Savio Resende <savio@savioresende.com.br>
 */

namespace Features\Shortcodes;

use Repositories\Books;

class WTWriterShortcode implements Interfaces\WTShortcodeInterface
{
    protected $summary_template = "templates/writer/summary.php";

    protected $editor_template = "templates/writer/writer.php";

    protected $chapter_template = "templates/writer/partials/chapter.php";

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

            $action = sanitize_text_field($_GET['action']);

            switch ($action) {

                case "get-post":

                    $this->returnTemplate('editor_template');

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
    public function doAction(string $action, array $args = [])
    {

        switch ($action) {

            case "search-books":
                $this->searchBooks($args);
                break;

            case "search-chapters":
                break;

            case "search-posts":
                break;

            case "persist-book":
                break;

            case "persist-chapter":
                break;

            case "persist-post":
                break;

            case "delete-book":
                break;

            case "delete-chapter":
                break;

            case "delete-post":
                break;

        }

    }

    /**
     * Search by Books Taxonomy
     *
     * @param array $args
     * @return void
     */
    private function searchBooks(array $args)
    {
        global $posts;

        $books_repository = new Books();
        $posts = $books_repository->search([
            'post_type' => 'post',
            'posts_per_page' => '10',
            'author' => get_current_user_id(),
            'order_by' => 'date',
            'order' => 'DESC'//,
//            'tax_query' => array(
//                array(
//                    'taxonomy' => 'book'//,
//                    'field' => 'slug'//,
//                    'terms' => array ('dom-casmurro')
//                    'terms' => array ('*')
//                )
//            )
        ]);

        $this->returnTemplate('summary_template');

    }

}