<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use Exception;

class Ip2Asn
{
    private array $db;
    private $fh;

    public function __construct()
    {
        $this->fh = fopen(database_path('ip2asn-combined.tsv'), 'r');
        if ($this->fh === false) {
            throw new Exception('failed opening ip2asn database');
        }
        $this->db = $this->parseFileForDb();
    }

    public function lookup(string $ip): string
    {
        $start = 0;
        $end = count($this->db) - 1;
        $search = inet_pton($this->prefixIPv4($ip));

        if ($search === false) {
            return '0';
        }

        while ($start <= $end) {
            $current = (int) (($start + $end) / 2);
            $loc = $this->db[$current];
            fseek($this->fh, $loc);
            $row = fgets($this->fh);
            $data = explode("\t", $row, 4);
            $compare = inet_pton($this->prefixIPv4($data[1]));
            $asn = $data[2];
            if ($compare === $search) {
                return $asn;
            } elseif ($compare < $search) {
                $start = $current + 1;
            } elseif ($compare > $search) {
                $lastInnerSearchAsn = $asn;
                $end = $current - 1;
            }
        }

        return $lastInnerSearchAsn ?? $asn;
    }

    private function parseFileForDb(): array
    {
        fseek($this->fh, 0);

        $ret = [ftell($this->fh)];
        while (($row = fgets($this->fh)) !== false) {
            if ($row !== '') {
                $ret[] = ftell($this->fh);
            }
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
