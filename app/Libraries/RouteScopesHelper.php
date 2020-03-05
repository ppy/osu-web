<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Libraries;

use Route;

class RouteScopesHelper
{
    public $routes;

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
        file_put_contents($filename, str_replace('\/', '/', json_encode($this->toArray(), JSON_PRETTY_PRINT)));
    }
}
