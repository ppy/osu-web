# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class @OsuLayzr
  constructor: ->
    @observer = new MutationObserver(@reinit)

    $(document).on 'turbolinks:load', @init


  init: =>
    @layzr ?= Layzr()

    @reinit()
    @observer.observe document.body, childList: true, subtree: true


  reinit: =>
    @layzr.update().check().handlers(true)
