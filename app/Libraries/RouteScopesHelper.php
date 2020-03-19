<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use Route;

class RouteScopesHelper
{
    public $routes;

    // fills in any missing require-scopes:
    public function fillMissingMiddlewares()
    {
        // pass by reference so middlewares value can be reassigned.
        foreach ($this->routes as &$route) {
            $scopes = $route['scopes'];
            $middlewares = $route['middlewares'];

            $scopesString = presence(implode(',', $scopes));
            if ($scopesString === null) {
                continue;
            }

            // add missing middleware if necessary; exact order might be wrong.
            $newString = "require-scopes:{$scopesString}";
            $index = array_search('require-scopes', $middlewares, true);
            if ($index === false) {
                $middlewares[] = 'require-scopes';
            }

            $exists = false;
            foreach ($middlewares as &$middleware) {
                // replace existing value if it exists
                if (starts_with($middleware, 'require-scopes:')) {
                    $middleware = $newString;
                    $exists = true;
                }
            }

            // otherwise insert new value after require-scopes if possible.
            if (!$exists) {
                array_splice($middlewares, $index ? $index + 1 : count($middlewares), 0, $newString);
            }

            $route['middlewares'] = $middlewares;
        }
    }

    public function fromCsv(string $filename)
    {
        $csv = array_map('str_getcsv', file($filename));

        $routes = array_map(function ($line) use ($csv) {
            $a = array_combine($csv[0], $line);
            $a['middlewares'] = explode(',', $a['middlewares']);
            $a['scopes'] = array_filter(explode(',', $a['scopes']));

            return $a;
        }, $csv);

        array_shift($routes); // remove column header

        $this->routes = $routes;
    }

    public function fromJson(string $filename)
    {
        $this->routes = json_decode(file_get_contents($filename), true);
    }

    public function loadRoutes()
    {
        $this->routes = [];

        foreach (Route::getRoutes() as $route) {
            if (!starts_with($route->uri, 'api/')) {
                continue;
            }

            // uri will still have the placeholders and wrong verbs, but we don't need them.
            $request = request()->create($route->uri, 'GET');
            app()->instance('request', $request); // set current request so is_api_request can work.

            $uri = $route->uri;
            $middlewares = array_filter($route->gatherMiddleware(), function ($middleware) {
                // only consider the named middleware.
                return is_string($middleware);
            });
            $controller = $route->action['controller'] ?? null;
            $scopes = [];

            foreach ($middlewares as $middleware) {
                if (is_string($middleware) && starts_with($middleware, 'require-scopes:')) {
                    $scopes = array_merge($scopes, explode(',', substr($middleware, strlen('require-scopes:'))));
                }
            }

            sort($scopes);

            foreach ($route->methods as $method) {
                $this->routes[] = compact('uri', 'method', 'controller', 'middlewares', 'scopes');
            }
        }
    }

    public function toArray()
    {
        if (!isset($this->routes)) {
            $this->loadRoutes();
        }

        return $this->routes;
    }

    public function toCsv(string $filename)
    {
        $file = fopen($filename, 'w');
        fputcsv($file, ['uri', 'method', 'controller', 'middlewares', 'scopes']);

        foreach ($this->toArray() as $obj) {
            $fields = [
                $obj['uri'],
                $obj['method'],
                $obj['controller'],
                implode(',', $obj['middlewares']),
                implode(',', $obj['scopes']),
            ];

            fputcsv($file, $fields);
        }

        fclose($file);
    }

    public function toJson(string $filename)
    {
        file_put_contents($filename, str_replace('\/', '/', json_encode($this->toArray(), JSON_PRETTY_PRINT)."\n"));
    }
}
