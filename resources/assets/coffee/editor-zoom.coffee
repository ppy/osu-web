###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
class @EditorZoom
  constructor: ->
    $(document).on 'click', '.js-editor-zoom--start', @start
    $(document).on 'click', '.js-editor-zoom--end', @end


  toggle: (event, enable) =>
    event.preventDefault()

    $container = $(event.target).closest('.js-editor-zoom')

    $hiddenElements = $container.find('.js-editor-zoom--hidden')
    $visibleElements = $container.find('.js-editor-zoom--visible')
    $('body').css overflow: (if enable then 'hidden' else '')

    $hiddenElements.toggleClass 'hidden', enable
    $visibleElements.toggleClass 'hidden', !enable

    $container.toggleClass 'js-editor-zoom--full', enable

    $box = $container.find('.js-editor-zoom--box')

    if enable
      $box.focus()
    else
      $box.blur()

      reposition = -> $.publish 'stickyFooter:check'
      setTimeout reposition, 500


  end: (e) =>
    @toggle e, false


  start: (e) =>
    @toggle e, true
