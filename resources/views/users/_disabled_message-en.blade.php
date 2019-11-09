{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<h1>Uh-oh! It looks like your account has been disabled.</h1>

<p>
    There are a number of reasons that can result in your account being disabled:
</p>

<ul>
    <li>
        You have broken one or more of our <a href="{{ osu_url('user.rules') }}">community rules</a> or <a href="{{ osu_url('legal.terms') }}">terms of service</a>.
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
