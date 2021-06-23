<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Session;

class SessionManager extends \Illuminate\Session\SessionManager
{
    /**
     * Build the session instance.
     *
     * @param  \SessionHandlerInterface  $handler
     * @return \Illuminate\Session\Store
     */
    protected function buildSession($handler)
    {
        return new Store($this->config->get('session.cookie'), $handler);
    }

    // copied from upstream but with custom CacheBasedSessionHandler
    protected function createCacheHandler($driver)
    {
        $store = $this->config->get('session.store') ?: $driver;

        return new CacheBasedSessionHandler(
            clone $this->container->make('cache')->store($store),
            $this->config->get('session.lifetime')
        );
    }
}
