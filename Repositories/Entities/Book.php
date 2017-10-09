<?php
/**
 * Created by PhpStorm.
 * User: savioresende
 * Date: 2017-10-08
 * Time: 4:44 PM
 */

namespace Repositories\Entities;

class Book implements \Repositories\Interfaces\EntityInterface
{
    /**
     * @var int (post id)
     */
    protected $id = 0;

    /**
     * @var int (user id)
     */
    protected $post_author = 0;

    /**
     * @var string (datetime) e.g.: "2017-10-02 03:50:16"
     */
    protected $post_date = "";

    /**
     * @var string (datetime) e.g.: "2017-10-02 03:50:16"
     */
    protected $post_date_gmt = "";

    /**
     * @var string
     */
    protected $post_content = "";

    /**
     * @var string
     */
    protected $post_title = "";

    /**
     * @var string
     */
    protected $post_excerpt = "";

    /**
     * @var string
     */
    protected $post_status = "";

    /**
     * @var string
     */
    protected $comment_status = "";

    /**
     * @var string
     */
    protected $post_name = "";

    /**
     * @var string (datetime) e.g.: "2017-10-09 02:28:40"
     */
    protected $post_modified = "";

    /**
     * @var string (datetime) e.g.: "2017-10-09 02:28:40"
     */
    protected $post_modified_gmt = "";

    /**
     * @var int
     */
    protected $post_parent = 0;

    /**
     * @var string
     */
    protected $guid = "";

    /**
     * @var string (usually "post")
     */
    protected $post_type = "";

    /**
     * @var int
     */
    protected $comment_count = 0;

    /**
     *
     * @param string $name
     * @param $value
     */
    public function __set(string $name, $value)
    {
        if( isset($this->{$name}) )
            $this->{$name} = $value;
    }

    /**
     *
     * @param string $name
     */
    public function __get(string $name){
        return $this->{$name};
    }
}