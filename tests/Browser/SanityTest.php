<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Route;
use Tests\DuskTestCase;

class SanityTest extends DuskTestCase
{
    /**
     * @dataProvider provider
     */
    public function testPage($routePrefix, $factoryRunner)
    {
        $user = factory(\App\Models\User::class)->create();
        $scaffolding = $factoryRunner();

        foreach (Route::getRoutes()->get('GET') as $route) {
            if (!starts_with($route->uri, $routePrefix)) {
                continue;
            }

            $params = [];
            $paramNames = $route->parameterNames();
            foreach ($paramNames as $paramName) {
                if (isset($scaffolding[$paramName])) {
                    $params[$paramName] = $scaffolding[$paramName]->getKey();
                }
            }
            $route->parameters = $params;

            try {
                echo("\n".$route->getName()."\n");
                $this->browse(function (Browser $browser) use ($route, $params, $user, $scaffolding) {
                    $url = str_replace(config('app.url'), '', route($route->getName(), $params));
                    $browser
                        ->loginAs($user)
                        ->visit($url);

                    // $browser->driver->takeScreenshot('ss/'.str_replace('/', '\\', $url).'@2x.png');
                    $browser->assertDontSee('Oh no! Something broke! ;_;')
                        ->assertDontSee('Page Missing');
                    // ->assertSourceMissing("<script type=\"text/javascript\">alert('Found the following N+1 queries in this request:")
                });
            } catch (\Exception $err) {
                echo($err->getMessage()."\n");
                throw $err;
                // continue;
            }
        }
    }

    public function provider()
    {
        $routes = [
            [
                'beatmapsets/',
                function () {
                    $beatmapset = factory(\App\Models\Beatmapset::class)->create([
                        'discussion_enabled' => true,
                    ]);
                    $beatmap = factory(\App\Models\Beatmap::class)->create([
                        'beatmapset_id' => $beatmapset->getKey(),
                    ]);
                    $discussion = factory(\App\Models\BeatmapDiscussion::class)->create([
                        'beatmapset_id' => $beatmapset->getKey(),
                        'beatmap_id' => $beatmap->getKey(),
                    ]);

                    return [
                        'beatmapset' => $beatmapset,
                        'beatmap_discussion' => $discussion,
                    ];
                },
            ],

        ];

        return $routes;
    }
}
