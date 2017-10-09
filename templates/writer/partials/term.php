<?php

/**
 * Chapter template
 *
 * @author Savio Resende <savio@savioresende.com.br>
 *
 * @internal This file is to always run inside the WTWriterShortcode context
 */

global $term,
       $wp;

$this_book_url = home_url(add_query_arg([
    'action' => 'search-chapters',
    'book' => $term->term_id
],$wp->request));

?>

<article
    id="post-<?php echo $term->term_id; ?>"
    class="blog-entry clr isotope-entry col span_1_of_4 grid-entry col-3 post-<?php echo $term->term_id; ?> post type-post status-publish format-standard has-post-thumbnail hentry category-lifestyle tag-lifestyle tag-woman entry has-media flex-item">

    <div class="blog-entry-inner clr">

        <?php /*
        <div class="thumbnail">

            <a href="http://local.wordpress.dev/2016/08/01/dapibus-diam-sed-nisi-nulla-quis-sem/" class="thumbnail-link no-lightbox">

                <img src="http://local.wordpress.dev/wp-content/uploads/2016/08/img_1035489.jpg" class="attachment-large size-large wp-post-image" alt="Dapibus diam sed nisi nulla quis sem" itemprop="image" srcset="http://local.wordpress.dev/wp-content/uploads/2016/08/img_1035489.jpg 848w, http://local.wordpress.dev/wp-content/uploads/2016/08/img_1035489-300x200.jpg 300w, http://local.wordpress.dev/wp-content/uploads/2016/08/img_1035489-768x513.jpg 768w" sizes="(max-width: 848px) 100vw, 848px" width="848" height="566">

            </a>

        </div><!-- .thumbnail -->
        */ ?>

        <header class="blog-entry-header clr">
            <h2 class="blog-entry-title entry-title">
                <a href="<?php echo $this_book_url; ?>" title="Dapibus diam sed nisi nulla quis sem" rel="bookmark"><?php echo $term->name; ?></a>
            </h2><!-- .blog-entry-title -->
        </header><!-- .blog-entry-header -->

        <?php /*
        <ul class="meta clr">

            <li class="meta-cat"><i class="icon-folder"></i><a href="http://local.wordpress.dev/category/lifestyle/" rel="category tag">Lifestyle</a></li>

            <li class="meta-comments"><i class="icon-bubble"></i><a href="http://local.wordpress.dev/2016/08/01/dapibus-diam-sed-nisi-nulla-quis-sem/#comments" class="comments-link">2 Comments</a></li>

        </ul>
        */ ?>

        <?php /*<div class="blog-entry-summary clr" itemprop="text">

            <?php echo substr(strip_tags($term->post_content), 0, 150) . ( (strlen(strip_tags($term->post_content)) > 150)?"...":"" ); ?>

        </div><!-- .blog-entry-summary -->*/ ?>

        <?php /*<div class="blog-entry-readmore clr">
            <a href="http://local.wordpress.dev/2016/08/01/dapibus-diam-sed-nisi-nulla-quis-sem/" title="Continue Reading">Continue Reading<i class="fa fa-angle-right"></i></a>
        </div><!-- .blog-entry-readmore -->*/ ?>

        <footer class="wt-summary-item-options">

            <a class="wt-summary-item-options-link" href="#"><span class="dashicons dashicons-edit"></span></a>

            <a class="wt-summary-item-options-link" href="#"><span class="dashicons dashicons-trash"></span></a>

        </footer>

    </div><!-- .blog-entry-inner -->

</article>
