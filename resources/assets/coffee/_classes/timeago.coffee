###
#    Copyright 2015-2017 ppy Pty. Ltd.
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

class @Timeago
  constructor: ->
    @observer = new MutationObserver (mutations) =>
      mutations.forEach (mutation) =>
        mutation.addedNodes.forEach (addedNode) =>
          # not all node types have querySelectorAll
          addedNode.querySelectorAll && addedNode.querySelectorAll('.timeago').forEach (node) =>
            @moment node

    $(document).on 'turbolinks:load', =>
      document.querySelectorAll('.timeago').forEach (node) =>
        @moment node

      @observer.observe document.body, childList: true, subtree: true

    @constructor.timer ?= setInterval () =>
      document.querySelectorAll('.timeago').forEach (node) =>
        @moment node
    , 60000

  moment: (elem) ->
    datetime = elem.getAttribute('datetime')
    from_now = moment(datetime).fromNow()
    elem.textContent = from_now
