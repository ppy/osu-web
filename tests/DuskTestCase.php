<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Exception\TimeoutException;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Illuminate\Support\Collection;
use Laravel\Dusk\Browser;
use Laravel\Dusk\TestCase as BaseTestCase;

abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Prepare for Dusk test execution.
     *
     * @beforeClass
     * @return void
     */
    public static function prepare()
    {
        $chromeDriver = presence(env('DUSK_WEBDRIVER_BIN'));
        if ($chromeDriver !== null) {
            static::$chromeDriver = $chromeDriver;
        }

        if (!present(env('DUSK_DRIVER_URL'))) {
            static::startChromeDriver(['--port=9515']);
        }
    }

    /**
     * Resets passed browser session.
     * Currently only clears existing cookies.
     *
     * @return void
     */
    protected static function resetSession(Browser $browser): void
    {
        $browser->driver->manage()->deleteAllCookies();
    }

    protected function browseWithRetries(callable $callback): void
    {
        $attempts = 1;
        while (true) {
            try {
                $this->browse($callback);
                break;
            } catch (TimeoutException $e) {
                if ($attempts++ > 5) {
                    throw $e;
                }
                static::closeAll();
            }
        }
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver(): RemoteWebDriver
    {
        // this is a copy of the original with --no-sandbox added (and linted)
        $options = (new ChromeOptions())->addArguments(collect([
            $this->shouldStartMaximized() ? '--start-maximized' : '--window-size=1920,1080',
            '--disable-search-engine-choice-screen',
            '--disable-smooth-scrolling',
        ])->unless($this->hasHeadlessDisabled(), function (Collection $items) {
            return $items->merge([
                '--disable-gpu',
                '--headless=new',
                '--no-sandbox',
            ]);
        })->all());

        return RemoteWebDriver::create(
            $_ENV['DUSK_DRIVER_URL'] ?? env('DUSK_DRIVER_URL') ?? 'http://localhost:9515',
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY,
                $options
            )
        );
    }

    protected function setUp(): void
    {
        parent::setUp();

        foreach (static::$browsers as $browser) {
            static::resetSession($browser);
        }
    }
}
