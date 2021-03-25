# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

$(document).on 'ajax:success', '.js-logout-link', (_event, data) ->
  localStorage.clear()

  osu.reloadPage()

  if (data?.captcha_triggered == true)
    osuCore.captcha.trigger();
  else
    osuCore.captcha.untrigger();
