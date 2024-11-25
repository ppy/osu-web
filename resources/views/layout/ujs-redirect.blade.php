{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
$(document).off('.ujsHideLoadingOverlay');
Turbo.cache.clear();
Turbo.visit({!! json_encode($url) !!});
