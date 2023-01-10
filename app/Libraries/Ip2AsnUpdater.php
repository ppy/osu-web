<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use Log;

class Ip2AsnUpdater
{
    public static function getDbPath()
    {
        return database_path('ip2asn.tsv');
    }

    public static function getIndexPath()
    {
        return database_path('ip2asn.idx');
    }

    public function run(?callable $logger = null): void
    {
        $logger ??= function (string $message) {
            Log::info("ip2asn: {$message}");
        };

        $logger('Checking db for updates');

        $dbPath = static::getDbPath();
        $indexPath = static::getIndexPath();

        $dbExists = file_exists($dbPath);

        $dbExpireTime = time() - (24 * 3600);
        $newDb = !$dbExists || filemtime($dbPath) < $dbExpireTime;

        $newIndex = !$dbExists || !file_exists($indexPath) || filemtime($dbPath) > filemtime($indexPath);
        if (!$newDb && !$newIndex) {
            $logger('All relevant files are up to date');

            return;
        }

        if ($newDb) {
            $logger('Db file is outdated. Downloading');
            $tsv = gzdecode(file_get_contents('https://iptoasn.com/data/ip2asn-combined.tsv.gz'));
        } else {
            $tsv = file_get_contents($dbPath);
        }

        $logger('Indexing db');
        $currentLine = 0;
        $index = pack('l', $currentLine);
        while (($currentLine = strpos($tsv, "\n", $currentLine)) !== false) {
            $currentLine++;
            if (isset($tsv[$currentLine])) {
                $index .= pack('l', $currentLine);
            }
        }

        $logger('Writing db and index to file');
        if ($newDb) {
            file_put_contents($dbPath, $tsv);
        }
        file_put_contents($indexPath, $index);

        $logger('Finished updating db');
    }
}
