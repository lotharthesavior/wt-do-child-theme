<?php
/**
 * Writer Summary
 *
 * @Savio Resende <savio@savioresende.com.br>
 *
 * @internal This file is to always run inside the WTWriterShortcode context
 */

global $terms;

?>

<div class="wt-shortcode-header">
    <h2>Books</h2>

    <a class="wt-header-shortcode-btn button" href="">New Book</a>

    <div class="cleaner"></div>
</div>

<div class="flex-container">

<?php

while ($terms->valid())
{
    global $term;

    $key = $terms->key();

    $term = $terms->current();

//    echo "<pre>";var_dump($term);exit;

    $this->returnTemplate('term_template');

    $terms->next();
}

?>
</div>
