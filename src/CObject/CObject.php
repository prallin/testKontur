<?php

/**
 * Holding a instance of CKontur to enable use of $this in subclasses.
 *
 * @package KonturCore
 */
class CObject {

    /**
     * Members
     */
    protected $kontur;
    protected $config;
    protected $request;
    protected $data;
    protected $db;
    protected $views;
    protected $session;
    protected $user;

    /**
     * Constructor
     */
    protected function __construct($kontur = null) {
        if (!$kontur) {
            $kontur = CKontur::Instance();
        }
        $this->kontur = &$kontur;
        $this->config = &$kontur->config;
        $this->request = &$kontur->request;
        $this->data = &$kontur->data;
        $this->db = &$kontur->db;
        $this->views = &$kontur->views;
        $this->session = &$kontur->session;
        $this->user = &$kontur->user;
    }

    /**
     * Wrapper for same method in CKontur. See there for documentation.
     */
    protected function RedirectTo($urlOrController = null, $method = null, $arguments = null) {
        $this->kontur->RedirectTo($urlOrController, $method, $arguments);
    }

    /**
     * Wrapper for same method in CKontur. See there for documentation.
     */
    protected function RedirectToController($method=null, $arguments=null) {
         $this->kontur->RedirectToController($method, $arguments);
    }

    /**
     * Wrapper for same method in CKontur. See there for documentation.
     */
    protected function RedirectToControllerMethod($controller = null, $method = null) {
        $this->kontur->RedirectToControllerMethod($controller, $method);
    }

    /**
     * Wrapper for same method in CKontur. See there for documentation.
     */
    protected function AddMessage($type, $message, $alternative = null) {
        return $this->kontur->AddMessage($type, $message, $alternative);
    }

    /**
     * Wrapper for same method in CKontur. See there for documentation.
     */
    protected function CreateUrl($urlOrController = null, $method = null, $arguments = null) {
        return $this->kontur->CreateUrl($urlOrController, $method, $arguments);
    }

}
