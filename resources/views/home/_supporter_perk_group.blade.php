{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

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
@php
    $section = isset($group['section']) ? $group['section'] : 'perks';
@endphp

<div class="supporter-perk-list">
    <div class="supporter-perk-list__list">
        @foreach($group['items'] as $name => $options)
            <div class="supporter-perk-list-group{{$section !== 'perks' ? " supporter-perk-list-group--{$section}" : ''}}">
                <div class="supporter-perk-list-group__icon">
                    <span class="fa-stack">
                        <i class="fas fa-circle fa-stack-2x supporter-perk-list-group__icon-bg"></i>
                        @foreach($options['icons'] as $icon)
                            <i class="{{ $icon }} fa-stack-1x"></i>
                        @endforeach
                    </span>
                </div>

                <div class="supporter-perk-list-group__text">
                    <h4 class="supporter-perk-list-group__title">
                        {!! trans("community.support.{$section}.{$name}.title") !!}
                    </h4>
                    <p class="supporter-perk-list-group__content">
                        {!! trans("community.support.{$section}.{$name}.description", $options['translation_options'] ?? []) !!}
                        @if (isset($options['link']))
                            {!! link_to(
                                $options['link'],
                                trans("community.support.{$section}.{$name}.link_text"),
                                [
                                    'class' => 'supporter-perk-list-group__link',
                                    'rel' => 'nofollow noreferrer',
                                    'target' => '_blank',
                                ]
                            ) !!}
                        @endif
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>
