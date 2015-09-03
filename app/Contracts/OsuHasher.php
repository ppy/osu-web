<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Contracts;

use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class OsuHasher implements HasherContract
{
    protected $hasher;
    protected $rounds = 4;

    /**
     * Hash the given value.
     *
     * @param string $value
     *
     * @return array  $options
     * @return string
     */
    public function make($value, array $options = [])
    {
        if (isset($options['osu_migration']) && $options['osu_migration']) {
            $cost = isset($options['cost']) ? $options['cost'] : $this->rounds;

            $hash = password_hash(md5($value), PASSWORD_BCRYPT, ['cost' => $cost]);

            // see static::check()
            return str_replace('$2y$', '$2a$', $hash);
        }

        return md5($value);
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
        if (strlen($hashedValue) == 60) {
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

        return md5($value) === $hashedValue;
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
        if (isset($options['osu_migration']) && $options['osu_migration']) {
            if ((strlen($hashedValue) == 32) && ctype_xdigit($hashedValue)) {
                // md5
                return true;
            } else {
                $cost = isset($options['rounds']) ? $options['rounds'] : $this->rounds;
                $hashedValue = str_replace('$2a$', '$2y$', $hashedValue);

                return password_needs_rehash($hashedValue, PASSWORD_BCRYPT, ['cost' => $cost]);
            }
        }

        return false;
    }
}
