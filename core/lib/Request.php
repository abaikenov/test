<?php

namespace core;

// Singleton
class Request
{
    private $method;
    private $host;
    private $get;
    private $post;
    private static $_instance = null;

    private function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->host = $_SERVER['HTTP_HOST'];
        $this->get = $_REQUEST;
        unset($this->get['PHPSESSID']);
        $this->post = $_POST;
    }

    protected function __clone()
    {
    }

    static public function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function isPost()
    {
        return $this->method === 'POST';
    }

    public function isGet()
    {
        return $this->method === 'GET';
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function post($key = null, $default = null)
    {
        if(null !== $key) {
            if(!empty($this->post[$key]))
                return $this->post[$key];
            else
                return $default;
        }
        return $this->post;
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function get($key = null, $default = null)
    {
        if(null !== $key) {
            if(!empty($this->get[$key]))
                return $this->get[$key];
            else
                return $default;
        }
        return $this->get;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

}