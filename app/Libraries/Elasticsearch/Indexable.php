<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Elasticsearch;

interface Indexable
{
    public static function esIndexingQuery();
    public function esRouting();
    public function esDeleteDocument(array $options = []);
    public function esIndexDocument(array $options = []);
    public function esShouldIndex();
    public function getEsId();
    public function toEsJson();
}
