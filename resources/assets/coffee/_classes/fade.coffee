###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

class @Fade
  @isVisible: (el) ->
    el?.getAttribute('data-visibility') != 'hidden'


  @out: (el) ->
    el?.setAttribute('data-visibility', 'hidden')


  @in: (el) ->
    el?.setAttribute('data-visibility', 'visible')


  @toggle: (el, makeVisible) =>
    return unless el?

    makeVisible ?= !@isVisible el

    if makeVisible
      @in el
    else
      @out el
