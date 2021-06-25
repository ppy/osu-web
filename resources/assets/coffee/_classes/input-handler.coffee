# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.


class @InputHandler
  @CANCEL = 'cancel'
  @SUBMIT = 'submit'

  @KEY_ENTER = 13
  @KEY_ESC = 27

  @textarea: (callback) =>
    (event) =>
      if event.keyCode == @KEY_ESC
        type = @CANCEL
      else if event.keyCode == @KEY_ENTER && !event.shiftKey && osuCore.windowSize.isDesktop
        event.preventDefault()
        type = @SUBMIT

      callback?(type, event)
