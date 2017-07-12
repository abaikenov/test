<?php

namespace core;

class Controller
{
    public $id;
    public $layout;
    public $request;

    private $_view;
    private $_viewPath;

    public $defaultAction = 'index';

    final public function __construct($id)
    {
        $this->id = $id;
        $this->setView(new View());
        $this->request = Request::getInstance();
        Session::init();
    }

    public function getView()
    {
        return $this->_view;
    }

    public function setView($view)
    {
        $this->_view = $view;
    }

    public function getViewPath()
    {
        if ($this->_viewPath === null) {
            $this->_viewPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $this->id;
        }
        return $this->_viewPath;
    }

    public function render($view, $params = [])
    {
        $content = $this->getView()->render($view, $params, $this);
        echo $this->renderContent($content);
    }

    public function renderContent($content)
    {
        $layoutFile = $this->findLayoutFile($this->getView());
        if ($layoutFile !== false) {
            return $this->getView()->renderFile($layoutFile, ['content' => $content]);
        }
        return $content;
    }

    public function findLayoutFile($view)
    {
        if(null === $this->layout)
            $this->layout = 'main';

        return __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . $this->layout . '.php';
    }

    public function redirect($url)
    {
        header('Location: ' . $url);
    }

}