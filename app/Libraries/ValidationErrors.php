<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

    public function __construct($prefix, $keyBase = 'model_validation.')
    {
        $this->prefix = $prefix;
        $this->keyBase = $keyBase;
    }

    public function add($column, $rawMessage, $params = null)
    {
        $this->errors[$column] ?? ($this->errors[$column] = []);

        $params ?? ($params = []);

        if ($rawMessage[0] === '.') {
            $rawMessage = $this->prefix.$rawMessage;
        }
        $rawMessage = $this->keyBase.$rawMessage;

        $params['attribute'] = $column;

        $this->errors[$column][] = trans($rawMessage, $params);
    }

    public function addTranslated($column, $message)
    {
        $this->errors[$column][] = $message;
    }

    public function merge(self $validationErrors)
    {
        $errors = $validationErrors->all();
        foreach ($errors as $key => $value) {
            // merge with existing key if any.
            $this->errors[$key] = array_merge($this->errors[$key] ?? [], $value);
        }

        return $this;
    }

    public function reset()
    {
        $this->errors = [];
    }

    public function isEmpty()
    {
        return count($this->errors) === 0;
    }

    public function isAny()
    {
        return !$this->isEmpty();
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

    public function toSentence($separator = "\n")
    {
        return implode($separator, $this->allMessages());
    }
}
