<?php

namespace Mali\View;

class View
{
    public static function make($view, $params = [])
    {
        $viewContent = self::getViewContent($view, params: $params);

        echo $viewContent;
    }

    protected static function getViewContent($view, $isError = false, $params = [])
    {
        $path = $isError ? view_path() . 'errors/' : view_path();

        if(str_contains($view, '.'))
        {
            $views = explode('.', $view);
            foreach($views as $view)
            {
                if(is_dir($path . $view))
                {
                    $path = $path . $view . '/';
                }
            }
            $view = $path . end($views) . '.php';
        }
        else
        {
            $view = $path . $view . '.php';
        }

        foreach($params as $param => $value)
        {
            $$param = $value;
        }

        if($isError)
        {
            include $view;
        }
        else
        {
            ob_start();
            include $view;
            return ob_get_clean();
        }
    }

    public static function makeError($error)
    {
        self::getViewContent($error, true);
    }
}
