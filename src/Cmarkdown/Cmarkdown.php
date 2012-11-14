<?php

/**
 * Description of Cmarkdown
 * A wrapper for PHP Markdown Extra by Michel Fortin, http://michelf.ca/projects/php-markdown/

 * @package KonturCore
 * @author gustav
 */
class Cmarkdown {

    /**
     * Properties
     */
    public static $instance = null;

    /**
     * Create an instance of arkdown if it does not exists. 
     *
     * @param $text string the dirty HTML.
     * @returns string as the clean HTML.
     */
    public static function DoMarkdown($text) {
        if (!self::$instance) {
            require_once(__DIR__ . '/PHP-Markdown-Extra/markdown.php');
            return $cleanhtml = Markdown($text);
        }
        return $cleanhtml = Markdown($text);
    }

}

?>
    