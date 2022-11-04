<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use League\Fractal;

class TransformerAbstract extends Fractal\TransformerAbstract
{
    protected $permissions = [];
    protected $requiredPermission;

    public function getPermissions()
    {
        return $this->permissions;
    }

    public function getRequiredPermission()
    {
        return $this->requiredPermission;
    }

    protected function callIncludeMethod(Fractal\Scope $scope, $includeName, $data)
    {
        if (!$this->hasPermission($includeName, $data)) {
            return false;
        }

        return parent::callIncludeMethod($scope, $includeName, $data);
    }

    protected function hasPermission($include, $data)
    {
        $permissionRequired = $this->permissions[$include] ?? null;

        return $permissionRequired === null || priv_check($permissionRequired, $data)->can();
    }
}
