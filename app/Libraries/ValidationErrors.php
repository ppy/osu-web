<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use Lang;

class ValidationErrors
{
    private $errors = [];

    public function __construct($prefix, $keyBase = 'model_validation.')
    {
        $this->prefix = $prefix;
        $this->keyBase = $keyBase;
    }

    public function add($column, $rawMessage, $params = null): self
    {
        $this->errors[$column] ?? ($this->errors[$column] = []);

        $params ?? ($params = []);

        if ($rawMessage[0] === '.') {
            $rawMessage = $this->prefix.$rawMessage;
        }
        $rawMessage = $this->keyBase.$rawMessage;

        $attributeKey = $this->keyBase.$this->prefix.'.attributes.'.$column;
        $params['attribute'] = Lang::has($attributeKey) ? osu_trans($attributeKey) : $column;

        $this->errors[$column][] = osu_trans($rawMessage, $params);

        return $this;
    }

    public function addTranslated($column, $message): self
    {
        $this->errors[$column][] = $message;

        return $this;
    }

    public function merge(self $validationErrors): self
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
