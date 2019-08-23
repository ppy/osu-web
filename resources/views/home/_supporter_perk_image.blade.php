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
                {{ trans("community.support.perks.{$group['name']}.title") }}
            </h4>
            <p class="supporter-perk-list-image__content">
                {{ trans("community.support.perks.{$group['name']}.description") }}
            </p>
        </div>
    </div>
</div>
