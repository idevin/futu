<?php


function routeLink(string $routeName, $parameters = [], bool $absolute = false): string
{

    if (!isset($parameters['locale'])) {
        if (is_array($parameters)) {
            $parameters = array_merge(['locale' => session()->get('locale')], $parameters);
        } else {
            $parameters = ['locale' => session()->get('locale'), $parameters];
        }
    }

    $route = route($routeName, $parameters, $absolute);

    if (env('APP_ENV') != 'local' && $absolute == false) {
        $route = blogPrefix(false) . $route;
    } else {
        $route = route($routeName, $parameters, false);
        $route = request()->root() . blogPrefix(false) . $route;
    }

    return $route;
}
