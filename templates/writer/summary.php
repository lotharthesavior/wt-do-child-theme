<?php
/**
 * Writer Summary
 *
 * @Savio Resende <savio@savioresende.com.br>
 *
 * @internal This file is to always run inside the WTWriterShortcode context
 */

global $posts;

$this->returnTemplate('breadcrumb_template');

?>

<div class="wt-shortcode-header">
    <h2>Chapters</h2>

    <a class="wt-header-shortcode-btn button" href="">New Chapter</a>

    <div class="cleaner"></div>
</div>

<div class="flex-container">
<?php

while ($posts->valid())
{
    global $post;

    $key = $posts->key();

    $post = $posts->current();

//    echo "<pre>";var_dump($post);exit;

    $this->returnTemplate('chapter_template');

    $posts->next();
}

?>
</div>
