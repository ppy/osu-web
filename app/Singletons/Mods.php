<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Singletons;

use App\Exceptions\InvariantException;
use Ds\Set;

class Mods
{
    // A => B: mod A implies mod B.
    const IMPLIED_MODS = [
        'DC' => 'HT',
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

    /**
     * Determines whether the given mods are valid for a playlist item.
     *
     * @param int $rulesetId The ruleset from which the mods originate.
     * @param array $ids An array containing the mod acronyms to test.
     * @param bool $required True if the mods are intended as "required" mods on the target playlist item. False if they're intended as "allowed" mods.
     * @param bool $realtime Whether the room is a realtime match.
     * @param bool $freestyle Whether the target playlist item enables freestyle mode.
     * @throws InvariantException When any of the given mods are not valid.
     */
    public function assertValidForMultiplayer(int $rulesetId, array $ids, bool $required, bool $realtime, bool $freestyle): void
    {
        $this->validateSelection($rulesetId, $ids);

        if ($realtime) {
            $attr = $required ? 'ValidForMultiplayer' : 'ValidForMultiplayerAsFreeMod';
        } else {
            $attr = 'UserPlayable';
        }

        foreach ($ids as $id) {
            $mod = $this->mods[$rulesetId][$id];

            if ($freestyle && $required && !$mod['ValidForFreestyleAsRequiredMod']) {
                throw new InvariantException("mod cannot be set as required on freestyle items: {$id}");
            }

            if (!$mod[$attr]) {
                $messageType = $required ? 'required' : 'allowed';
                throw new InvariantException("mod cannot be set as {$messageType}: {$id}");
            }
        }
    }

    public function excludeModsAlwaysValidForSubmission(int $rulesetId, array $modIds): array
    {
        return array_values(array_filter($modIds, fn ($modId) => !$this->mods[$rulesetId][$modId]['AlwaysValidForSubmission']));
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

    public function assertValidExclusivity(int $rulesetId, array $modAcronyms): void
    {
        $disallowedIds = new Set();

        foreach ($modAcronyms as $modAcronym) {
            $incompatibleIds = $this->mods[$rulesetId][$modAcronym]['IncompatibleMods'];
            $disallowedIds->add(...$incompatibleIds);
        }

        $invalidIds = $disallowedIds->intersect(new Set($modAcronyms));
        if ($invalidIds->count() > 0) {
            throw new InvariantException("incompatible mods: {$invalidIds->join(', ')}");
        }
    }

    public function assertValidMultiplayerExclusivity(int $rulesetId, array $requiredIds, array $allowedIds): void
    {
        $this->assertValidExclusivity($rulesetId, $requiredIds);

        $disallowedIds = new Set();

        foreach ($requiredIds as $requiredId) {
            $incompatibleIds = $this->mods[$rulesetId][$requiredId]['IncompatibleMods'];
            $disallowedIds->add($requiredId, ...$incompatibleIds);
        }

        $invalidAllowedIds = $disallowedIds->intersect(new Set($allowedIds));

        if ($invalidAllowedIds->count() > 0) {
            throw new InvariantException("allowed mods conflict with required mods: {$invalidAllowedIds->join(', ')}");
        }
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
