{{--
    Copyright 2015-2018 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
@extends('rankings.index')

@section('ranking-header')
    <div class="spotlight-period-pager">
        @php
            $prevUrl = route('rankings', [
                'type' => 'monthly',
                'mode' => request('mode'),
                'country' => request('country'),
                'before' => $spotlight->chart_month->year,
            ]);
            $nextUrl = route('rankings', [
                'type' => 'monthly',
                'mode' => request('mode'),
                'country' => request('country'),
                'after' => $spotlight->chart_month->year,
            ]);
        @endphp
        <a
            class="spotlight-period-pager__more"
            href="{{ $prevUrl }}"
        >
            @if (!$range->first()->is($earliest))
                <span class="fas fa-angle-left"></span>
            @endif
        </a>
        @foreach ($range as $s)
            <a
                class="spotlight-period-pager__item {{ $spotlight->chart_id === $s->chart_id ? 'spotlight-period-pager__item--selected' : '' }}"
                href="{{ route('rankings', ['type' => 'monthly', 'mode' => request('mode'), 'country' => request('country'), 'spotlight' => $s->chart_id]) }}"
            >
                @if ($s->type === 'monthly')
                    <div class="spotlight-period-pager__month">
                        {{ $s->chart_month->format('m') }}
                    </div>
                @endif
                <div class="spotlight-period-pager__year">
                    {{ $s->chart_month->format('Y') }}
                </div>
            </a>
        @endforeach
        <a
            class="spotlight-period-pager__more"
            href="{{ $nextUrl }}"
        >
            @if (!$range->last()->is($latest))
                <span class="fas fa-angle-right"></span>
            @endif
        </a>
    </div>
@endsection

@section('scores')
    @include('rankings._spotlight_rankings_table', compact('scores'))
@endsection

@section('ranking-footer')
    @include('rankings._beatmapsets', compact('beatmapsets'))
@endsection
