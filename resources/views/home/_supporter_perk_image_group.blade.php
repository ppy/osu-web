{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="supporter-perk-list">
    <div class="supporter-perk-list__list">
        @foreach($group['items'] as $name => $options)
            @if (strlen($name) > 0)
                <div class="supporter-perk-list-group supporter-perk-list-group--image">
                    <img
                        class="supporter-perk-list-group__image"
                        src="/images/layout/supporter/{{$name}}.jpg"
                        srcSet="/images/layout/supporter/{{$name}}.jpg 1x, /images/layout/supporter/{{retinaify($name.'.jpg')}} 2x"
                    />
                    <div class="supporter-perk-list-group__meta">
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
                                {{ osu_trans("community.support.perks.{$name}.title") }}
                            </h4>
                            <p class="supporter-perk-list-group__content">
                                {{ osu_trans("community.support.perks.{$name}.description") }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
