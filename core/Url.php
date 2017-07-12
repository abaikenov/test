<?php
namespace core;

class Url
{
    public static function to($route, $params = [], $withOldQuery = false)
    {
        if ($withOldQuery) {
            $request = Request::getInstance();
            $params = array_merge($request->get(), $params);
        }

        $route = '/' . ltrim($route, '/');
        if (!empty($params))
            $route .= '?' . http_build_query($params);

        return $route;
    }
}