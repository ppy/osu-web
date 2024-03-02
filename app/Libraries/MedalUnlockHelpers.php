<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use App\Listeners\MedalUnlocks\MedalUnlock;
use Illuminate\Support\Facades\Queue;
use ReflectionClass;
use ReflectionException;
use ReflectionNamedType;
use ReflectionUnionType;
use Symfony\Component\Finder\Finder;

class MedalUnlockHelpers
{
    public static function discoverMedalUnlocks(): array
    {
        $dirs = array_filter([
            app_path('Listeners/MedalUnlocks'),
            base_path('hush-hush-medals/src'),
        ], 'is_dir');
        $files = (new Finder())->files()->name('*.php')->in($dirs);

        $discoveredEvents = [];

        foreach ($files as $file) {
            $medalUnlockClass = substr($file->getRealPath(), 0, -4); // Remove ".php"
            $medalUnlockClass = str_replace_first(app_path(), 'App', $medalUnlockClass);
            $medalUnlockClass = str_replace_first(
                base_path('hush-hush-medals'.DIRECTORY_SEPARATOR.'src'),
                'App\\Listeners\\MedalUnlocks\\HushHush',
                $medalUnlockClass,
            );
            $medalUnlockClass = str_replace(DIRECTORY_SEPARATOR, '\\', $medalUnlockClass);

            try {
                $medalUnlock = new ReflectionClass($medalUnlockClass);
            } catch (ReflectionException) {
                continue;
            }

            if (
                !$medalUnlock->isInstantiable() ||
                !$medalUnlock->isSubclassOf(MedalUnlock::class) ||
                !$medalUnlock->hasProperty('event')
            ) {
                continue;
            }

            $eventPropertyType = $medalUnlock->getProperty('event')->getType();
            $eventPropertyTypes = array_filter(
                match (true) {
                    $eventPropertyType instanceof ReflectionNamedType => [$eventPropertyType],
                    $eventPropertyType instanceof ReflectionUnionType => $eventPropertyType->getTypes(),
                    default => [],
                },
                fn (ReflectionNamedType $type) => !$type->isBuiltin(),
            );

            foreach ($eventPropertyTypes as $type) {
                $typeName = $type->getName();
                $discoveredEvents[$typeName] ??= [];
                $discoveredEvents[$typeName][] = "{$medalUnlock->name}@handle";
            }
        }

        return $discoveredEvents;
    }

    public static function registerQueueCreatePayloadHook(): void
    {
        Queue::createPayloadUsing(function ($connection, $queue, array $payload) {
            $medalUnlock = $payload['displayName'];

            if (str_starts_with($medalUnlock, get_class_namespace(MedalUnlock::class))) {
                return ['data' => array_merge(
                    $payload['data'],
                    ['state' => $medalUnlock::getQueueableState()],
                )];
            }

            return [];
        });
    }
}
