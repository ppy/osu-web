# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { hideLoadingOverlay } from 'utils/loading-overlay'

export default class ForumTopicWatchAjax
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
    hideLoadingOverlay()

    target = e.currentTarget

    target.dataset.skipAjaxErrorPopup = '0'
    target.classList.add 'js-forum-topic-watch-ajax--loading'
    target.disabled = true

    return


  shouldContinue: (e) =>
    @unknownState || e.currentTarget.dataset.forumTopicWatchAjaxIsActive != '1'
