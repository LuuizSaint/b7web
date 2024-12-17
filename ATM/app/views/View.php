<?php

namespace app\views;

use Exception;

class View
{
    public function executor(string $view, array $data)
    {
        $viewPath = $this->viewFound($view);

        ob_start();
        extract($data);
        require $viewPath;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    private function viewFound(string $view)
    {
        $viewPath = dirname(__FILE__, 2)."/views/pages/{$view}.php";
        if(!file_exists($viewPath))
        {
            throw new Exception("View {$view} inexistente!");
        }

        return $viewPath;
    }
}