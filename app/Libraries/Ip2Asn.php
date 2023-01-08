<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use Exception;

class Ip2Asn
{
    private $dbFh;
    private string $index;
    private int $count;

    public function __construct()
    {
        $this->dbFh = fopen(Ip2AsnUpdater::getDbPath(), 'r');
        $index = file_get_contents(Ip2AsnUpdater::getIndexPath());
        if ($this->dbFh === false || $index === false) {
            throw new Exception('failed opening ip2asn database or index');
        }
        $this->index = $index;

        // 4 bytes per entry (int32)
        $this->count = strlen($this->index) / 4;
    }

    public function lookup(string $ip): string
    {
        $start = 0;
        $end = $this->count - 1;
        $search = inet_pton($this->prefixIPv4($ip));

        if ($search === false) {
            return '0';
        }

        while ($start <= $end) {
            $current = (int) (($start + $end) / 2);
            $loc = unpack('l', substr($this->index, $current * 4, 4))[1];
            fseek($this->dbFh, $loc);
            $row = fgets($this->dbFh);
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
