<?php
/**
 * Template for Words Tree - Writer
 *
 * @author Savio Resende <savio@savioresende.com.br>
 */


// code to be used to receive the request
//$args = array(
//    'post_type' => 'my_custom_post',
//    /*other default parameters you want to set*/
//);
//$post_id = wp_insert_post($args);
//if(!is_wp_error($post_id)){
//    //the post is valid
//}else{
//    //there was an error in the post insertion,
//    echo $post_id->get_error_message();
//}

?>

<style>
    .woocommerce button.button {
        padding-top: 0px !important;
        padding-bottom: 0px !important;
    }

    div.mce-toolbar-grp,
    .quicktags-toolbar{
        border-bottom: none !important;
        background: #f5f5f5 !important;
    }

    .wp-editor-container {
        border: none !important;
        border-top: 1px solid #eaeaea !important;
    }

    .wp-switch-editor {
        border-radius: 1px !important;
    }
</style>

<?php

wp_editor( "test content", "wt-editor-content");

?>