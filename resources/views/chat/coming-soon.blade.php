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
@extends('master', [
    'bodyAdditionalClasses' => 'osu-layout__no-scroll',
    'currentSection' => 'community',
    'legacyNav' => false,
    'title' => trans('chat.title'),
])

@section("content")
    <div class="header-v3 header-v3--chat">
        <div class="header-v3__bg"></div>
        <div class="header-v3__overlay"></div>
        <div class="osu-page osu-page--header-v3">
            <div class="osu-page-header-v3 osu-page-header-v3--chat">
                <div class="osu-page-header-v3__title">
                    <div class="osu-page-header-v3__title-icon">
                        <div class="osu-page-header-v3__icon"></div>
                    </div>
                    <h1 class="osu-page-header-v3__title-text">{{trans('chat.title')}}</h1>
                </div>
            </div>
            <ol class="page-mode-v2 page-mode-v2--breadcrumbs page-mode-v2--chat"></ol>
        </div>
    </div>
    <div class="chat osu-page osu-page--chat">
        <div class="chat__not-active">
            <img title="Art by Badou_Rammsteiner"
                src="/images/layout/chat/coming-soon.png"
                srcSet="/images/layout/chat/coming-soon.png 1x, /images/layout/chat/coming-soon@2x.png 2x">
            <div class="chat__title">{{trans('chat.coming_soon')}}</div>
        </div>
    </div>
@endsection
