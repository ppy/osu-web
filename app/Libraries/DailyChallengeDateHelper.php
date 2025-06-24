<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use App\Models\Multiplayer\Room;
use Carbon\CarbonImmutable;

class DailyChallengeDateHelper
{
    const string DATE_FORMAT = 'Y-m-d';

    private array $days;
    private CarbonImmutable $requestMonth;
    private array $roomRange;
    private CarbonImmutable $now;

    public function __construct(private CarbonImmutable $requestDate)
    {
        $this->roomRange = array_map(
            fn (string $dbTime): CarbonImmutable => parse_db_time($dbTime)->toImmutable()->startOfDay(),
            Room::dailyChallenges()
                ->selectRaw('
                    COALESCE(MIN(created_at), CURRENT_TIMESTAMP) first_room_at,
                    COALESCE(MAX(created_at), CURRENT_TIMESTAMP) last_room_at
                ')->first()
                ->getAttributes(),
        );
        $this->now = CarbonImmutable::today();
        $this->requestMonth = $this->requestDate->startOfMonth();
    }

    public static function roomId(Room $room): string
    {
        return static::makeId($room->starts_at);
    }

    public static function makeId(\DateTimeInterface $date): string
    {
        return $date->format(static::DATE_FORMAT);
    }

    public static function makeOption(CarbonImmutable $date, string $part): array
    {
        return [
            'id' => static::makeId($date),
            'text' => i18n_date(
                $date,
                pattern: match ($part) {
                    'day' => 'd',
                    'month' => 'MMMM',
                    'year' => 'y',
                },
            ),
        ];
    }

    private static function clamp(
        CarbonImmutable $date,
        CarbonImmutable $min,
        CarbonImmutable $max,
    ): CarbonImmutable {
        return $date < $min
            ? $min
            : ($date > $max
                ? $max
                : $date
            );
    }

    public function days(): array
    {
        if (!isset($this->days)) {
            $dateYearMonth = $this->requestDate->format('Y-m');

            $minDate = $this->roomRange['first_room_at'];

            $this->days = array_map(
                fn (int $day): CarbonImmutable => $this->requestDate->setDay($day),
                range(
                    $dateYearMonth === $minDate->format('Y-m')
                        ? $minDate->day
                        : 1,
                    $dateYearMonth === $this->roomRange['last_room_at']->format('Y-m')
                        ? $this->roomRange['last_room_at']->day
                        : ($dateYearMonth === $this->now->format('Y-m')
                            ? $this->now->day
                            : $this->requestDate->endOfMonth()->day
                        ),
                ),
            );
            $additionalDayCount = 28 - count($this->days);
            for ($i = 1; $i <= $additionalDayCount; $i++) {
                $moreDate = $this->days[0]->subDay();
                if ($moreDate->lessThan($minDate)) {
                    break;
                }
                array_unshift($this->days, $moreDate);
            }
        }

        return $this->days;
    }

    public function firstId(): string
    {
        return static::makeId($this->roomRange['first_room_at']);
    }

    public function isCurrentMonth(CarbonImmutable $date): bool
    {
        return $date->month === $this->requestMonth->month
            && $date->year === $this->requestMonth->year
            && $date->greaterThanOrEqualTo($this->roomRange['first_room_at'])
            && $date->lessThanOrEqualTo($this->roomRange['last_room_at']);
    }

    public function lastId(): string
    {
        return static::makeId($this->roomRange['last_room_at']);
    }

    public function nextMonthId(): ?string
    {
        if ($this->requestMonth->greaterThanOrEqualTo($this->roomRange['last_room_at']->startOfMonth())) {
            return null;
        }

        $date = static::clamp(
            $this->requestDate->addMonthNoOverflow(),
            $this->roomRange['first_room_at'],
            $this->roomRange['last_room_at'],
        );

        return static::makeId($date);
    }

    public function options(string $part): array
    {
        return array_map(
            fn (CarbonImmutable $date): array => static::makeOption($date, $part),
            match ($part) {
                'day' => $this->days(),
                'month' => $this->months(),
                'year' => $this->years(),
            },
        );
    }

    public function prevMonthId(): ?string
    {
        if ($this->requestMonth->lessThanOrEqualTo($this->roomRange['first_room_at']->startOfMonth())) {
            return null;
        }

        $date = static::clamp(
            $this->requestDate->subMonthNoOverflow(),
            $this->roomRange['first_room_at'],
            $this->roomRange['last_room_at'],
        );

        return static::makeId($date);
    }

    private function months(): array
    {
        return array_map(
            fn (int $month): CarbonImmutable =>
                $this->setDayClamped($this->requestMonth->setMonth($month)),
            range(
                $this->requestDate->year === $this->roomRange['first_room_at']->year
                    ? $this->roomRange['first_room_at']->month
                    : 1,
                $this->requestDate->year === $this->roomRange['last_room_at']->year
                    ? $this->roomRange['last_room_at']->month
                    : ($this->requestDate->year === $this->now->year
                        ? $this->now->month
                        : 12
                    )
            ),
        );
    }

    private function years(): array
    {
        return array_map(
            fn (int $year): CarbonImmutable =>
                $this->setDayClamped($this->requestMonth->setYear($year)),
            range(
                $this->roomRange['first_room_at']->year,
                $this->roomRange['last_room_at']->year,
            ),
        );
    }

    private function setDayClamped(CarbonImmutable $dateMonth): CarbonImmutable
    {
        return static::clamp(
            $dateMonth->setDay($this->requestDate->day),
            $dateMonth,
            $dateMonth->endOfMonth()->startOfDay(),
        );
    }
}
