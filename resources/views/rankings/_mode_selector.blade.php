{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

<ul class="page-mode">
    @foreach (App\Models\Beatmap::MODES as $tab => $_int)
        <li class="page-mode__item">
            <a class="page-mode-link{{$mode == $tab ? ' page-mode-link--is-active' : ''}}" href="{{$route($tab, $type)}}">
                {{trans("beatmaps.mode.{$tab}")}}
                <span class="page-mode-link__stripe"></span>
            </a>
        </li>
    @endforeach
</ul>
