<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use App\Exceptions\InvariantException;
use Ds\Set;

class Mods
{
    // A => B: mod A implies mod B.
    const IMPLIED_MODS = [
        'NC' => 'DT',
        'PF' => 'SD',
    ];

    const LEGACY_BITSET = [
        1 << 0 => 'NF' ,
        1 << 1 => 'EZ' ,
        1 << 2 => 'TD' ,
        1 << 3 => 'HD' ,
        1 << 4 => 'HR' ,
        1 << 5 => 'SD' ,
        1 << 6 => 'DT' ,
        1 << 7 => 'RX' ,
        1 << 8 => 'HT' ,
        1 << 9 => 'NC' ,
        1 << 10 => 'FL' ,
        1 << 12 => 'SO' ,
        1 << 13 => 'AP' ,
        1 << 14 => 'PF' ,
        1 << 20 => 'FI' ,
        1 << 21 => 'RD' ,
        1 << 29 => 'V2' ,
        1 << 30 => 'MR' ,

        // mania keys (converts)
        1 << 15 => '4K' ,
        1 << 16 => '5K' ,
        1 << 17 => '6K' ,
        1 << 18 => '7K' ,
        1 << 19 => '8K' ,
        1 << 24 => '9K' ,
    ];

    const LEGACY_PREFERENCE_MODS_BITSET = 0b01000000000000000100001000100000; // SD, NC, PF, MR

    public Set $allIds;
    public array $idToBitsetMap;
    public Set $difficultyReductionIds;
    public array $mods = [];

    public function __construct()
    {
        $this->idToBitsetMap = array_flip(static::LEGACY_BITSET);
        $this->difficultyReductionIds = new Set();
        $this->allIds = new Set();

        $metadata = json_decode(file_get_contents(database_path('mods.json')), true);

        foreach ($metadata as $byRuleset) {
            $rulesetId = $byRuleset['RulesetID'];

            $this->mods[$rulesetId] ??= [];

            foreach ($byRuleset['Mods'] as $mod) {
                $id = $mod['Acronym'];

                $mod['Bitset'] = $this->idToBitsetMap[$id] ?? null;

                $mod['IncompatibleMods'] = new Set($mod['IncompatibleMods']);
                // it can't be incompatible with itself.
                $mod['IncompatibleMods']->remove($id);

                $keyedSettings = [];
                foreach ($mod['Settings'] as $setting) {
                    $keyedSettings[$setting['Name']] = $setting;
                }
                $mod['Settings'] = $keyedSettings;

                $this->mods[$rulesetId][$id] = $mod;

                if ($mod['Type'] === 'DifficultyReduction') {
                    $this->difficultyReductionIds->add($id);
                }
                $this->allIds->add($id);
            }
        }
    }

    public function assertValidForMultiplayer(int $rulesetId, array $ids, bool $isRealtime, bool $isRequired): void
    {
        $this->validateSelection($rulesetId, $ids);

        if ($isRealtime) {
            $attr = $isRequired ? 'ValidForMultiplayer' : 'ValidForMultiplayerAsFreeMod';
        } else {
            $attr = 'UserPlayable';
        }

        foreach ($ids as $id) {
            $mod = $this->mods[$rulesetId][$id];

            if (!$mod[$attr]) {
                $messageType = $isRequired ? 'required' : 'allowed';
                throw new InvariantException("mod cannot be set as {$messageType}: {$id}");
            }
        }
    }

    public function idsToBitset($ids): int
    {
        if (!is_array($ids)) {
            return 0;
        }

        return array_reduce(
            $ids,
            // - ignores mods which don't have bitset
            // - includes implied mods (as that's how it's stored in db)
            fn (int $carry, string $id) =>
                $carry
                | ($this->idToBitsetMap[$id] ?? 0)
                | ($this->idToBitsetMap[static::IMPLIED_MODS[$id] ?? null] ?? 0),
            0,
        );
    }

    public function assertValidExclusivity(int $rulesetId, array $requiredIds, array $allowedIds): bool
    {
        $disallowedIds = new Set();

        while (($requiredId = array_pop($requiredIds)) !== null) {
            $mod = $this->mods[$rulesetId][$requiredId];
            $incompatibleIds = $mod['IncompatibleMods'];
            $disallowedIds->add($requiredId, ...$incompatibleIds);

            $invalidRequiredIds = $incompatibleIds->intersect(new Set($requiredIds));
            if ($invalidRequiredIds->count() > 0) {
                throw new InvariantException("incompatible mods: {$requiredId}, {$invalidRequiredIds->join(', ')}");
            }
        }

        $invalidAllowedIds = $disallowedIds->intersect(new Set($allowedIds));

        if ($invalidAllowedIds->count() > 0) {
            throw new InvariantException("allowed mods conflict with required mods: {$invalidAllowedIds->join(', ')}");
        }

        return true;
    }

    public function bitsetToIds(int $inputBitset): array
    {
        $set = new Set();

        foreach (static::LEGACY_BITSET as $bitset => $id) {
            if (($bitset & $inputBitset) !== 0) {
                $set->add($id);
            }
        }

        foreach (static::IMPLIED_MODS as $id => $impliedId) {
            if ($set->contains($id)) {
                $set->remove($impliedId);
            }
        }

        return $set->toArray();
    }

    public function filterSettings(int $rulesetId, string $id, $settings): object
    {
        if ($settings === null || !is_array($settings)) {
            return (object) [];
        }

        $cleanSettings = [];

        foreach ($settings as $key => $value) {
            $type = $this->mods[$rulesetId][$id]['Settings'][$key]['Type'] ?? null;

            if ($type === null) {
                throw new InvariantException("unknown setting for {$id} ({$key})");
            } else {
                $cleanSettings[$key] = get_param_value($value, $type);
            }
        }

        return (object) $cleanSettings;
    }

    public function parseInputArray(int $rulesetId, array $mods): array
    {
        $filteredMods = [];

        foreach ($mods as $mod) {
            if (!present($mod['acronym'] ?? null)) {
                throw new InvariantException('invalid mod array');
            }

            $filteredMods[$mod['acronym']] = (object) [
                'acronym' => $mod['acronym'],
                'settings' => $this->filterSettings($rulesetId, $mod['acronym'], $mod['settings'] ?? null),
            ];
        }
        $cleanMods = array_values($filteredMods);

        $this->validateSelection($rulesetId, array_column($cleanMods, 'acronym'));

        return $cleanMods;
    }

    public function validateSelection(int $rulesetId, array $ids): bool
    {
        $validMods = $this->mods[$rulesetId] ?? null;

        if ($validMods === null) {
            throw new InvariantException('invalid ruleset');
        }

        $checkedIds = new Set();
        foreach ($ids as $id) {
            if (!isset($validMods[$id])) {
                throw new InvariantException("invalid mod for ruleset: {$id}");
            }

            if ($checkedIds->contains($id)) {
                throw new InvariantException("duplicate mod for ruleset: {$id}");
            }
            $checkedIds->add($id);
        }

        return true;
    }
}
