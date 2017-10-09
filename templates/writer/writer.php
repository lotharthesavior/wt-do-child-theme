<?php
/**
 * Template for Words Tree - Writer
 *
 * @author Savio Resende <savio@savioresende.com.br>
 */

global $chapter;

$this->returnTemplate('breadcrumb_template');

?>

<div class="wt-shortcode-header">
    <h2><?php echo $chapter->post_title; ?></h2>

    <a class="wt-header-shortcode-btn button" href="">Save</a>

    <div class="cleaner"></div>
</div>

<div class="cleaner"></div>

<?php

wp_editor( $chapter->post_content, "wt-editor-content");

?>