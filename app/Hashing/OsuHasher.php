<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
