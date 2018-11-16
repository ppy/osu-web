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

$(document).on 'ajax:success', '.js-forum-poll-edit', (e, data, status, xhr) ->
  $(e.target).trigger('ajax:complete', [xhr, status])

  $poll = $('.js-forum-poll')

  $poll
    .attr 'data-original-poll', $poll.html()
    .html data

  osu.pageChange()


$(document).on 'click', '.js-forum-poll-edit-cancel', ->
  $poll = $('.js-forum-poll')
  $poll
    .html $poll.attr('data-original-poll')
    .attr 'data-original-poll', null

  osu.pageChange()


$(document).on 'ajax:success', '.js-forum-poll-edit-save', (e, data, status, xhr) ->
  $(e.target).trigger('ajax:complete', [xhr, status])

  $poll = $('.js-forum-poll')
    .html $(data).html()
    .attr 'data-original-poll', null

  osu.pageChange()


$(document).on 'ajax:success', '.edit-post-link', (e, data, status, xhr) ->
  # ajax:complete needs to be triggered early because the link (target) is
  # removed in this callback.
  $(e.target).trigger('ajax:complete', [xhr, status])

  $postBox = $(e.target).parents('.js-forum-post')

  $postBox
    .attr 'data-original-post', $postBox.html()
    .html data
    .find '[name=body]'
    .focus()

  osu.pageChange()


$(document).on 'click', '.js-edit-post-cancel', (e) ->
  e.preventDefault()

  $postBox = $(e.target).parents '.js-forum-post'
  $postBox
    .html $postBox.attr('data-original-post')
    .attr 'data-original-post', null

  osu.pageChange()


$(document).on 'ajax:success', '.js-forum-post-edit', (e, data, status, xhr) ->
  # ajax:complete needs to be triggered early since the form (target) is
  # removed in this callback.
  $(e.target)
    .trigger('ajax:complete', [xhr, status])
    .parents('.js-forum-post').replaceWith(data)

  osu.pageChange()
