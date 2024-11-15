{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
;(function() {
    $(document).off(".ujsHideLoadingOverlay");
    window.setTimeout(() => Turbo.visit({!! json_encode($url) !!}), 0);
}).call(this);
