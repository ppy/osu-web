<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use App\Http\Middleware\RequireScopes;
use Closure;
use Ds\Set;
use Illuminate\Contracts\Http\Kernel as HttpKernelContract;
use Route;

class RouteScopesHelper
{
    public $routes;

    private static $requireScopesPrefix = RequireScopes::class.':';

    public static function keyForMethods(array $methods)
    {
        sort($methods);

        return implode('|', $methods);
    }

    public function fromCsv(string $filename)
    {
        $csv = array_map('str_getcsv', file($filename));

        $routes = array_map(function ($line) use ($csv) {
            $a = array_combine($csv[0], $line);
            $a['methods'] = explode('|', $a['methods']);
            $a['middlewares'] = explode('|', $a['middlewares']);
            $a['scopes'] = array_filter(explode('|', $a['scopes']));

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
        // Force the http kernel singleton to boot if it hasn't.
        // This ensures the router has the middleware groups loaded.
        app(HttpKernelContract::class);

        $this->routes = [];
        $apiGroup = new Set(Route::getMiddlewareGroups()['api']);

        /** @var \Illuminate\Routing\Route $route */
        foreach (Route::getRoutes() as $route) {
            if (!starts_with($route->uri, 'api/')) {
                continue;
            }

            // uri will still have the placeholders and wrong verbs, but we don't need them.
            $request = request()->create($route->uri, 'GET');
            app()->instance('request', $request); // set current request so is_api_request can work.

            $uri = $route->uri;

            // filter out closures and global middleware.
            $middlewares = array_values(array_filter(
                Route::gatherRouteMiddleware($route),
                fn ($middleware) => !($middleware instanceof Closure) && !$apiGroup->contains($middleware)
            ));
            $controller = $route->action['controller'] ?? null;

            // extract scopes
            $scopes = [];

            foreach ($middlewares as $middleware) {
                if (is_string($middleware) && starts_with($middleware, static::$requireScopesPrefix)) {
                    $scopes = array_merge($scopes, explode(',', substr($middleware, strlen(static::$requireScopesPrefix))));
                }
            }

            sort($scopes);

            $methods = $route->methods;
            sort($methods);

            $this->routes[] = compact('uri', 'methods', 'controller', 'middlewares', 'scopes');
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
        fputcsv($file, ['uri', 'methods', 'controller', 'middlewares', 'scopes']);

        foreach ($this->toArray() as $obj) {
            $fields = [
                $obj['uri'],
                implode('|', $obj['methods']),
                $obj['controller'],
                implode('|', $obj['middlewares']),
                implode('|', $obj['scopes']),
            ];

            fputcsv($file, $fields);
        }

        fclose($file);
    }

    public function toJson(string $filename)
    {
        file_put_contents($filename, json_encode($this->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)."\n");
    }
}
