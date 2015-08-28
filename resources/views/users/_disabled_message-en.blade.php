{{--
    Copyright 2015 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
<h1>Uh-oh! It looks like your account has been disabled.</h1>

<p>
	There are a number of reasons that can result in your account being disabled:
</p>

<ul>
	<li>
		You have broken one or more of our <a href="{{ config("osu.urls.user.rules") }}">community rules</a> or <a href="{{ config("osu.urls.legal.tos") }}">terms of service</a>.
	</li>
	<li>
		Your account has deemed to be compromised. It may be disabled temporarily while its identity is confirmed.
	</li>
</ul>

<p>
	In the case you have broken a rule, please note that there is generally a cool-down period of one month during which we will not consider any amnesty requests. After this period, you are free to contact us should you deem it necessary. Please note that creating new accounts after you have had one disabled will result in an <strong>extension of this one month cool-down</strong>. Please also note that for <strong>every account you create, you are further breaking rules</strong>. We highly suggest you don't go down this path!
</p>

<p>
	If you feel this is a mistake, you are welcome to contact us (via <a href="mailto:{{ config("osu.emails.account") }}">email</a><!-- or by clicking the "?" in the bottom-right-hand corner of this page -->). Please note that we are always fully confident with our actions, as they are based on very solid data. We reserve the right to disregard your request should we feel you are being intentionally dishonest.
</p>
