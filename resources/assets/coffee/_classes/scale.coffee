# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class window.Scale
  constructor: ->
    @els = document.getElementsByClassName('js-scale')

    $(document).on 'turbolinks:load', @resizeAll
    $(window).on 'resize', @resizeAll


  readParentSize: (el) =>
    el.parentSize = el.parentElement.getBoundingClientRect()


  resize: (el) =>
    parentSize = el.parentSize

    switch el.dataset.scale
      when 'ws'
        if parentSize.width / parentSize.height > 16 / 9
          width = parentSize.width
          height = 9 / 16 * width
        else
          height = parentSize.height
          width = 16 / 9 * height

    if height? && width?
      el.style.height = "#{height}px"
      el.style.width = "#{width}px"


  resizeAll: =>
    @readParentSize(el) for el in @els
    @resize(el) for el in @els
