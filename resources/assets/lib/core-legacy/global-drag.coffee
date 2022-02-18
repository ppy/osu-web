# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

export default class GlobalDrag
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
