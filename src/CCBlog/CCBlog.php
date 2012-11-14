<?php

/**
 * Description of CCBlog
 * controller for blog, List content markt as post in blog way
 * @package KonturCore
 */
class CCBlog extends CObject implements IController{
    
    /**
     * construktor
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * index
     */
    public function Index() {
        $content = new CMContent();
        $this->views->SetTitle('Blog')
                ->AddInclude(__DIR__ . '/index.tpl.php', array('contents' => $content->ListAll(array('type' => 'post', 'order_by' => 'title', 'order-order'=>'DESC'))));
    }
}

?>
