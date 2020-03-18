{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
;(function() {
    $(document).off(".ujsHideLoadingOverlay")
    Turbolinks.visit({!! json_encode($url) !!})
}).call(this);
