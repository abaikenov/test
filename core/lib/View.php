<?php

namespace core;

class View
{
    public $context;
    public $defaultExtension = 'php';

    public function render($view, $params = [], $context)
    {
        if(null !== $context)
            $this->context = $context;

        $file = $context->getViewPath() . DIRECTORY_SEPARATOR . $view . '.' . $this->defaultExtension;
        return $this->renderFile($file, $params);
    }

    public function renderFile($file, $params = [])
    {
        $_obInitialLevel_ = ob_get_level();
        ob_start();
        ob_implicit_flush(false);
        extract($params, EXTR_OVERWRITE);
        try {
            require($file);
            return ob_get_clean();
        } catch (\Exception $e) {
            while (ob_get_level() > $_obInitialLevel_) {
                if (!@ob_end_clean()) {
                    ob_clean();
                }
            }
            throw $e;
        } catch (\Throwable $e) {
            while (ob_get_level() > $_obInitialLevel_) {
                if (!@ob_end_clean()) {
                    ob_clean();
                }
            }
            throw $e;
        }
    }
}