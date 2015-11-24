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
class @SyncHeight
  targets: document.getElementsByClassName('js-sync-height--target')
  references: document.getElementsByClassName('js-sync-height--reference')

  constructor: ->
    $(document).on 'ready page:load', @sync
    $(window).on 'resize', _.throttle(@sync, 500)

    @sync()


  sync: =>
    heights = {}

    for reference in @references
      id = reference.getAttribute('data-sync-height-target')
      heights[id] = reference.getBoundingClientRect().height

    for target in @targets
      height = heights[target.getAttribute('data-sync-height-id')]

      if height != undefined
        target.style.minHeight = "#{height}px"
