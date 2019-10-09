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

namespace App\Hashing;

use Illuminate\Contracts\Hashing\Hasher;

class OsuHasher implements Hasher
{
    /**
     * The number of rounds to hash, as 2^n.
     *
     * @var int
     */
    protected $rounds = 10;

    /**
     * Get information about the given hashed value.
     *
     * @param string $hashedValue
     *
     * @return array
     */
    public function info($hashedValue)
    {
        return password_get_info(str_replace('$2a$', '$2y$', $hashedValue));
    }

    /**
     * Hash the given value.
     *
     * @param string $value
     *
     * @return string
     */
    public function make($value, array $options = [])
    {
        $cost = array_get($options, 'cost', $this->rounds);

        // When we originally moved to bcrypt (quite a few years ago),
        // we had to migrate everything without waiting for every user to
        // change their passwords, hence the md5 still being there.
        $hash = password_hash(md5($value), PASSWORD_BCRYPT, ['cost' => $cost]);

        // see static::check()
        return str_replace('$2y$', '$2a$', $hash);
    }

    /**
     * Check the given plain value against a hash.
     *
     * @param string $value
     * @param string $hashedValue
     * @param array  $options
     *
     * @return bool
     */
    public function check($value, $hashedValue, array $options = [])
    {
        // To clarify here: the 2y implementation of bcrypt is specific to
        // the crypt_blowfish implementation of bcrypt (that PHP uses).
        // the act of naming this bugfix "2y" was a stupid idea as it is not
        // an updated version of the algorithm at all.
        // 2a and 2y are literally identical; crypt_blowfish just had bugs in 2a

        // anyways, this replacement is because the .NET library this interacts with
        // needs 2a since a string replacement on every connection is needless overhead
        // for a realtime processing server and only lowers max connections.
        $hashedValue = str_replace('$2a$', '$2y$', $hashedValue);

        return password_verify(md5($value), $hashedValue);
    }

    /**
     * Check if the given hash has been hashed using the given options.
     *
     * @param string $hashedValue
     * @param array  $options
     *
     * @return bool
     */
    public function needsRehash($hashedValue, array $options = [])
    {
        $cost = array_get($options, 'cost', $this->rounds);
        $hashedValue = str_replace('$2a$', '$2y$', $hashedValue);

        return password_needs_rehash($hashedValue, PASSWORD_BCRYPT, ['cost' => $cost]);
    }
}
