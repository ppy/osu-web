<?php

namespace Tests;

use Laravel\Dusk\Browser as DuskBrowser;

class Browser extends DuskBrowser
{
    /**
     * Log into the application using a given user ID or email.
     *
     * @param  object|string  $userId
     * @param  string         $guard
     * @return $this
     */
    public function loginAs($userId, $guard = null)
    {
        // Overriden to forcibly kill the previous session when logging in to ensure we always get a fresh session.
        $this->driver->manage()->deleteAllCookies();

        $userId = method_exists($userId, 'getKey') ? $userId->getKey() : $userId;

        return $this->visit(rtrim('/_dusk/login/'.$userId.'/'.$guard, '/'));
    }
}
