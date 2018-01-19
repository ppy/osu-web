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

namespace App\Console\Commands;

use App\Models\Beatmapset;
use App\Models\User;
use App\Models\Forum\Post;
use Illuminate\Console\Command;

class EsIndexDocuments extends EsIndexCommand
{
    const ALLOWED_TYPES = [
        'beatmapsets' => Beatmapset::class,
        'posts' => Post::class,
        'users' => User::class,
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:index-documents {--types=} {--inplace} {--cleanup} {--yes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes documents into Elasticsearch.';

    protected function readOptions()
    {
        parent::readOptions();

        if ($this->option('types')) {
            $types = explode(',', $this->option('types'));
            $this->types = [];
            foreach ($types as $type) {
                $class = static::ALLOWED_TYPES[$type] ?? null;
                if ($class) {
                    $this->types[] = $class;
                }
            }
        } else {
            $this->types = array_values(static::ALLOWED_TYPES);
        }
    }
}
