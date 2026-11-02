{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div
    class="js-captcha--container {{ $params['containerClass'] ?? '' }}"
    data-captcha-triggered="{{ ($params['triggered'] ?? captcha_login_triggered()) ? '1' : '' }}"
></div>
<script>
    osuCore.turbolinksReload.load('https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit&onload=initCaptcha');
    function initCaptcha() { osuCore.captcha.init('{{ $GLOBALS['cfg']['turnstile']['site_key'] }}'); }
</script>
