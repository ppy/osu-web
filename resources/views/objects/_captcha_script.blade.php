{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
{{--
    we're explicitly avoiding NoCaptcha::renderJs here in order to use recaptcha.net instead of google.com (as the latter is blocked in mainland china)
    see: https://developers.google.com/recaptcha/docs/faq#can-i-use-recaptcha-globally
--}}
<script>
    osuCore.turbolinksReload.load('https://www.recaptcha.net/recaptcha/api.js?render=explicit&onload=initCaptcha&hl={{Lang::getLocale()}}');
    function initCaptcha() { osuCore.captcha.init('{{config('captcha.sitekey')}}', {{captcha_triggered() ? 'true' : 'false'}}); }
</script>
