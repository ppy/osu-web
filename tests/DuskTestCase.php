<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Exception\TimeoutException;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverDimension;
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

        if (!present(env('DUSK_WEBDRIVER_URL'))) {
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

    protected static function withRetries(callable $test): void
    {
        $attempts = 1;
        while (true) {
            try {
                $test();
                break;
            } catch (TimeoutException $e) {
                static::closeAll();
                if ($attempts++ > 5) {
                    throw $e;
                }
            }
        }
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        $options = (new ChromeOptions())->addArguments([
            '--disable-gpu',
            '--headless',
        ]);

        $driver = RemoteWebDriver::create(
            presence(env('DUSK_WEBDRIVER_URL')) ?? 'http://localhost:9515',
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY,
                $options
            )
        );

        // TODO: move this out when/if adding additional tests for mobile layout?
        $driver->manage()->window()
            ->setSize(new WebDriverDimension(1920, 1080)); // ensure we get desktop layout

        return $driver;
    }

    protected function setUp(): void
    {
        parent::setUp();

        foreach (static::$browsers as $browser) {
            static::resetSession($browser);
        }
    }
}
