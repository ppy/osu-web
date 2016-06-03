<?php

/**
 *    Copyright 2016 ppy Pty. Ltd.
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

class ValidationErrors
{
    private $errors = [];

    public function __construct($prefix)
    {
        $this->prefix = $prefix;
    }

    public function add($column, $rawMessage)
    {
        $this->errors[$column] ?? ($this->errors[$column] = []);

        if (is_array($rawMessage)) {
            $params = $rawMessage[1] ?? null;
            $rawMessage = $rawMessage[0];
        }

        $params ?? ($params = []);

        if ($rawMessage[0] === '.') {
            $rawMessage = $this->prefix.$rawMessage;
        }
        $rawMessage = 'model_validation.'.$rawMessage;

        $params['attribute'] = $column;

        $this->errors[$column][] = trans($rawMessage, $params);
    }

    public function reset()
    {
        $this->errors = [];
    }

    public function isAny()
    {
        return count($this->errors) === 0;
    }

    public function all()
    {
        return $this->errors;
    }

    public function allMessages()
    {
        $result = [];

        foreach ($this->errors as $_column => $messages) {
            $result = array_merge($result, $messages);
        }

        return $result;
    }
}
