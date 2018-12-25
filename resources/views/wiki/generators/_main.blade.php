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

@foreach($sections as $title => $section)
    <div class="wiki-main-page-panel">
        <div class="wiki-main-page-panel__title">{!! $title !!}</div>
        <div class="wiki-main-page-panel__links">
            @spaceless
            @foreach($section as $key => $link)
                <span class="wiki-main-page-panel__link">
                    @if (is_array($link))
                        {!! $key !!}
                            <span class="wiki-main-page-panel__sublinks">
                                @foreach ($link as $sublink)
                                    <span class="wiki-main-page-panel__link">{!! $sublink !!}</span>
                                @endforeach
                            </span>
                        </span>
                    @else
                        {!! $link !!}
                    @endif
                </span>
            @endforeach
            @endspaceless
        </div>
    </div>
@endforeach
