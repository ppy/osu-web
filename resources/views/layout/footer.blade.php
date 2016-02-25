{{--
    Copyright 2015 ppy Pty. Ltd.

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
<footer class="footer no-print flex-none">
    <div class="footer__row">
        <a class="footer__link" href="{{ config("osu.urls.legal.tos") }}" target="_blank">Terms of Service</a>
        <a class="footer__link" href="{{ config("osu.urls.legal.dmca") }}" target="_blank">Copyright (DMCA)</a>
        <a class="footer__link" href="{{ config("osu.urls.status.server") }}" target="_blank">Server Status</a>
        <a class="footer__link" href="{{ config("osu.urls.status.osustatus") }}" target="_blank">@osustatus</a>
    </div>
    <div class="footer__row">ppy powered 2007-{{ date("Y") }}</div>

    <div class="js-sync-height--target" data-sync-height-id="permanent-fixed-footer"></div>
</footer>
