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

import core from 'osu-core-singleton'
import * as React from 'react'
import { button, div, span } from 'react-dom-factories'
import { ShowMoreLink } from 'show-more-link'
import { Spinner } from 'spinner'


el = React.createElement

uiState = core.dataStore.uiState

bn = 'comment-show-more'

export class CommentShowMore extends React.PureComponent
  @defaultProps = modifiers: []


  constructor: (props) ->
    super props

    @state =
      loading: false


  componentWillUnmount: =>
    @xhr?.abort()


  render: =>
    return null if @props.comments.length >= @props.total
    return null unless (uiState.comments.hasMoreComments[@props.parent?.id ? null] ? true)

    blockClass = osu.classWithModifiers bn, @props.modifiers

    if 'top' in @props.modifiers
      remaining = @props.total - @props.comments.length
      modifiers = ['comments']
      if 'changelog' in @props.modifiers
        modifiers.push('t-greyviolet-darker')
      else
        modifiers.push('t-ddd')

      el ShowMoreLink,
        loading: @state.loading
        hasMore: true
        callback: @load
        modifiers: modifiers
        remaining: remaining
    else
      div className: blockClass,
        if @state.loading
          el Spinner
        else
          button
            className: "#{bn}__link"
            onClick: @load
            @props.label ? osu.trans('common.buttons.show_more')


  load: =>
    @setState loading: true

    params =
      commentable_type: @props.parent?.commentable_type ? @props.commentableType
      commentable_id: @props.parent?.commentable_id ? @props.commentableId
      parent_id: @props.parent?.id ? 0
      sort: uiState.comments.currentSort

    lastComment = _.last(@props.comments)
    if lastComment?
      params.cursor =
        id: lastComment.id
        created_at: lastComment.createdAt
        votes_count: lastComment.votesCount

    @xhr = $.ajax laroute.route('comments.index'),
      data: params
      dataType: 'json'
    .done (data) =>
      $.publish 'comments:added', data
    .always =>
      @setState loading: false
