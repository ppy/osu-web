{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
{{--
    use turbolinks initialiser
--}}
<script>
    osuCore.turbolinksReload.load('https://challenges.cloudflare.com/turnstile/v0/api.js?compat=recaptcha&render=explicit&onload=initCaptcha');
    function initCaptcha() { osuCore.captcha.init('{{ $GLOBALS['cfg']['turnstile']['site_key'] }}'); }
</script>
