###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
#
#    This file is part of osu!web. osu!web is distributed with the hope of
#    attracting more community contributions to the core ecosystem of osu!.
#
#    osu!web is free software: you can redistribute it and/or modify
#    it under the terms of the Affero GNU General Public License version 3
#    as published by the Free Software Foundation.
#
#    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
#    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
#    See the GNU Affero General Public License for more details.
#
#    You should have received a copy of the GNU Affero General Public License
#    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###


class @GlobalDrag
  constructor: ->
    $(document).on 'dragenter', @dragenter
    $(document).on 'dragover', @dragend


  dragenter: =>
    # The event bubbles, prevent retriggering the event unless
    # it really has just started.
    return if @dragging

    @dragging = true
    $.publish 'dragenterGlobal'


  # Triggered during dragover because there's no other way to detect if mouse
  # is still within the viewport.
  # Thankfully dragover is practically triggered any time mouse is inside the
  # viewport. Absence of this event means mouse has left the viewport.
  # Side effects include stupid amount of {set,clear}Timeout.
  dragend: (e) =>
    return unless @dragging

    trigger = =>
      @dragging = false
      $.publish 'dragendGlobal'

    Timeout.clear @dragendTimer
    @dragendTimer = Timeout.set 100, trigger
