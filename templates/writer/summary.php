<?php
/**
 * Writer Summary
 *
 * @Savio Resende <savio@savioresende.com.br>
 *
 * @internal This file is to always run inside the WTWriterShortcode context
 */

global $posts;

?>
<style>
    .flex-container {
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-flex-direction: row;
        -ms-flex-direction: row;
        flex-direction: row;
        -webkit-flex-wrap: wrap;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -webkit-justify-content: flex-start;
        -ms-flex-pack: start;
        justify-content: flex-start;
        -webkit-align-content: flex-start;
        -ms-flex-line-pack: start;
        align-content: flex-start;
        -webkit-align-items: flex-start;
        -ms-flex-align: start;
        align-items: flex-start;
    }

    .flex-item {
        -webkit-order: 0;
        -ms-flex-order: 0;
        order: 0;
        -webkit-flex: 3 1 30%;
        -ms-flex: 3 1 30%;
        flex: 3 1 30%;
        -webkit-align-self: flex-start;
        -ms-flex-item-align: start;
        align-self: flex-start;

        margin: 5px;
    }

    .blog-entry {

    }
</style>

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
