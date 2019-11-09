{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

<ul class="page-mode page-mode--ranking-page-mode-tabs">
    @foreach (['performance', 'charts', 'score', 'country'] as $tab)
        <li class="page-mode__item">
            <a class="page-mode-link page-mode-link--white{{$type == $tab ? ' page-mode-link--is-active' : ''}}"
                href="{{$tab == 'country' ? route('rankings', ['mode' => $mode, 'type' => $tab]) : $route($mode, $tab)}}"
            >
                {{trans("rankings.type.{$tab}")}}
                <span class="page-mode-link__stripe page-mode-link__stripe--black"></span>
            </a>
        </li>
    @endforeach
</ul>
