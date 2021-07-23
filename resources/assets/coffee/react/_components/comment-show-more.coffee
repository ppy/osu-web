# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton'
import * as React from 'react'
import { button, div, span } from 'react-dom-factories'
import ShowMoreLink from 'show-more-link'
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
