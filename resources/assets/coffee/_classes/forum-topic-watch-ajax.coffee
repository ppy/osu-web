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

class @ForumTopicWatchAjax
  constructor: ->
    $(document).on 'ajax:before', '.js-forum-topic-watch-ajax', @shouldContinue
    $(document).on 'ajax:send', '.js-forum-topic-watch-ajax', @loading
    $(document).on 'ajax:error', '.js-forum-topic-watch-ajax', @fail
    $(document).on 'ajax:success', '.js-forum-topic-watch-ajax', @done
    @xhr = []
    @unknownState = false


  abortAll: =>
    xhr.abort() while (xhr = @xhr.pop())?


  done: =>
    @unknownState = false


  fail: (e, _xhr, status) =>
    target = e.currentTarget

    target.dataset.skipAjaxErrorPopup = '1' if status == 'abort'
    target.classList.remove 'js-forum-topic-watch-ajax--loading'
    target.disabled = false

    return


  loading: (e, xhr) =>
    @unknownState = true
    @abortAll()
    @xhr.push xhr
    LoadingOverlay.hide()

    target = e.currentTarget

    target.dataset.skipAjaxErrorPopup = '0'
    target.classList.add 'js-forum-topic-watch-ajax--loading'
    target.disabled = true

    return


  shouldContinue: (e) =>
    @unknownState || e.currentTarget.dataset.forumTopicWatchAjaxIsActive != '1'
