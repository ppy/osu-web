{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="supporter-perk-list-image{{isset($group['variant']) ? " supporter-perk-list-image--{$group['variant']}" : ''}}">
    <div class="supporter-perk-list-image__image">
        <img
            src="/images/layout/supporter/{{$group['name']}}.jpg"
            srcSet="/images/layout/supporter/{{$group['name']}}.jpg 1x, /images/layout/supporter/{{retinaify($group['name'].'.jpg')}} 2x"
        />
    </div>
    <div class="supporter-perk-list-image__meta">
        <div class="supporter-perk-list-image__icon">
            <span class="fa-stack">
                <i class="fas fa-circle fa-stack-2x supporter-perk-list-image__icon-bg"></i>
                @foreach($group['icons'] as $icon)
                    <i class="{{ $icon }} fa-stack-1x"></i>
                @endforeach
            </span>
        </div>
        <div class="supporter-perk-list-image__text">
            <h4 class="supporter-perk-list-image__title">
                {{ osu_trans("community.support.perks.{$group['name']}.title") }}
            </h4>
            <p class="supporter-perk-list-image__content">
                {{ osu_trans("community.support.perks.{$group['name']}.description") }}
            </p>
        </div>
    </div>
</div>
