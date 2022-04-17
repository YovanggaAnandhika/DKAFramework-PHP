<?php

namespace yovanggaanandhika\dkaframework\Module\Routes;
require ('./../../../vendor/autoload.php');
use Bramus\Router\Router;
use MongoDB\BSON\Regex;

class Bramus {

    /**
     * @return mixed
     */
    /**
     * @param $bramus_router Router;
     */
    public function setBramusRouter($bramus_router): void
    {
        $this->bramus_router = $bramus_router;
    }

    /**
     * @return Router;
     */
    public function getBramusRouter()
    {
        return $this->bramus_router;
    }

    public static function Router() {

        $routes = new Router();
        (new Bramus)->setBramusRouter($routes);
    }

    /**
     * @param string $method
     * @param $pattern string
     * @return void
     */
    public static function match($method = 'GET | POST', $pattern, $callback) {
        $routes = (new Bramus)->getBramusRouter();
        $routes->match($method, $pattern, $callback);
    }

    public static function get($pattern, $callback){
        $routes = (new Bramus)->getBramusRouter();
        $routes->get($pattern, $callback);
    }

    public static function Run() {
        $routes = (new Bramus)->getBramusRouter();
        $routes->run();
    }
}
