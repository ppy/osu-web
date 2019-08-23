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
<div class="supporter-perk-list supporter-perk-list--image-list">
    <div class="supporter-perk-list__list">
        @foreach($perks as $name => $icon)
            @if (strlen($name) > 0)
                <div class="supporter-perk-item supporter-perk-item--feature supporter-perk-item--image-group{{$index == 0 ? ' supporter-perk-item--first' : ''}}">
                    <div class="supporter-perk-item__group-image">
                        <img
                            src="/images/layout/supporter/{{$name}}.jpg"
                            srcSet="/images/layout/supporter/{{$name}}.jpg 1x, /images/layout/supporter/{{retinaify($name.'.jpg')}} 2x"
                        />
                    </div>
                    <div class="supporter-perk-item__meta">
                        <div class="supporter-perk-item__icon">
                            <span class="fa-stack">
                                <i class="fas fa-circle fa-stack-2x supporter-perk-item__icon-bg"></i>
                                <i class="{{ $icon }} fa-stack-1x"></i>
                            </span>
                        </div>
                        <div class="supporter-perk-item__text">
                            <h4 class="supporter-perk-item__title">
                                {{ trans('community.support.perks.'.$name.'.title') }}
                            </h4>
                            <p class="supporter-perk-item__content">
                                {!! trans('community.support.perks.'.$name.'.description') !!}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
