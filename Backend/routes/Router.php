<?php

class Router
{
    private array $routes = [];

    public function get($uri, $action)
    {
        $this->addRoute('GET', $uri, $action);
    }
    public function post($uri, $action)
    {
        $this->addRoute('POST', $uri, $action);
    }
    public function put($uri, $action)
    {
        $this->addRoute('PUT', $uri, $action);
    }
    public function delete($uri, $action)
    {
        $this->addRoute('DELETE', $uri, $action);
    }

    private function addRoute($method, $uri, $action)
    {
        $this->routes[] = compact('method', 'uri', 'action');
    }

    public function dispatch($requestUri, $requestMethod)
    {
        // $requestUri = parse_url($requestUri, PHP_URL_PATH);

        $requestUri = parse_url($requestUri, PHP_URL_PATH);

        // Remove project base path automatically
        $basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        $requestUri = preg_replace('#^' . $basePath . '#', '', $requestUri);

        if ($requestUri === '') {
            $requestUri = '/';
        }


        foreach ($this->routes as $route) {

            $pattern = preg_replace('#\{[^}]+\}#', '([^/]+)', $route['uri']);
            $pattern = "#^" . $pattern . "$#";

            if ($route['method'] === $requestMethod && preg_match($pattern, $requestUri, $matches)) {

                array_shift($matches);

                [$controllerName, $method] = explode('@', $route['action']);

                // echo "Controller name $controllerName";
                require_once __DIR__ . "/../controller/$controllerName.php";

                // echo "hello from router";

                $controller = new $controllerName();

                $controller->$method(...$matches);
                return;
            }
        }

        http_response_code(404);
        echo json_encode([
            "status" => "error",
            "message" => "Route not found",
            "data" => null
        ]);
    }
}


?>