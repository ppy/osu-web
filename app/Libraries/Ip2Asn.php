<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

class Ip2Asn
{
    private array $db;

    public function __construct()
    {
        $this->db = $this->parseFileForDb();
    }

    public function lookup(string $ip): string
    {
        $start = 0;
        $end = count($this->db) - 1;
        $search = inet_pton($this->prefixIPv4($ip));

        while ($start <= $end) {
            $current = (int) (($start + $end) / 2);
            $compareRow = $this->db[$current];
            $compare = $compareRow[0];
            if ($compare === $search) {
                return $compareRow[1];
            } elseif ($compare < $search) {
                $start = $current + 1;
            } elseif ($compare > $search) {
                $lastInnerSearchAsn = $compareRow[1];
                $end = $current - 1;
            }
        }

        return $lastInnerSearchAsn ?? $compareRow[1];
    }

    private function parseFileForDb(): array
    {
        $rows = explode("\n", file_get_contents(database_path('ip2asn-combined.tsv')));

        $ret = [];
        foreach ($rows as $row) {
            if ($row === '') {
                continue;
            }
            $data = explode("\t", $row, 4);
            $ret[] = [
                inet_pton($this->prefixIPv4($data[1])),
                $data[2],
            ];
        }

        return $ret;
    }

    /**
     * Prefix IPv4 so it's sortable as IPv6
     */
    private function prefixIPv4(string $ip): string
    {
        return strpos($ip, ':') === false
            ? "::{$ip}"
            : $ip;
    }
}
