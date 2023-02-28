{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
                        {!! osu_trans("community.support.{$section}.{$name}.title") !!}
                    </h4>
                    <p class="supporter-perk-list-group__content">
                        {!! osu_trans("community.support.{$section}.{$name}.description", $options['translation_options'] ?? []) !!}
                        @if (isset($options['link']))
                            {!! link_to(
                                $options['link'],
                                osu_trans("community.support.{$section}.{$name}.link_text"),
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
