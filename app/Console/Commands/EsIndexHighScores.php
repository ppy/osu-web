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

use App\Libraries\Elasticsearch\Es;
use App\Libraries\Elasticsearch\Indexing;
use App\Libraries\Elasticsearch\SearchResponse;
use App\Models\Score\Best;
use Carbon\Carbon;
use Illuminate\Console\Command;

class EsIndexHighScores extends EsIndexDocuments
{
    const ALLOWED_TYPES = [
        'osu' => [Best\Osu::class],
        'fruits' => [Best\Fruits::class],
        'mania' => [Best\Mania::class],
        'taiko' => [Best\Taiko::class],
    ];

    const BATCH_SIZE = 1000;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:index-high-scores {--types=} {--inplace} {--cleanup} {--yes} {--reset}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes user high scores into Elasticsearch.';

    protected $reset;
    protected $skipCounts = true;

    public function getLastUpdated(string $index)
    {
        return Es::getClient('scores')->search([
            'body' => ['query' => ['ids' => ['values' => [$this->getRealIndexName($index)]]]],
            'index' => config('osu.elasticsearch.prefix').'_index_meta',
        ]);
    }

    public function getLastUpdatedId(string $index)
    {
        if ($this->reset) {
            return 0;
        }

        $response = new SearchResponse($this->getLastUpdated($index));

        return $response[0]->source('last_id');
    }

    public function setLastUpdated(string $index, Carbon $updatedAt, $id)
    {
        $indexName = $this->getRealIndexName($index);

        $document = [
            'index' => config('osu.elasticsearch.prefix').'_index_meta',
            'type' => 'index_meta',
            'id' => $indexName,
            'body' => [
                'index' => $indexName,
                'last_id' => $id,
                'updated_at' => $updatedAt->toIso8601String(),
            ],
        ];

        return Es::getClient()->index($document);
    }

    protected function readOptions()
    {
        parent::readOptions();

        $this->reset = $this->option('reset');
    }
}
