# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Comment } from 'comment'
import HeaderV4 from 'header-v4'
import { Observer } from 'mobx-react'
import core from 'osu-core-singleton'
import * as React from 'react'
import { a, button, div, h1, p, span } from 'react-dom-factories'

el = React.createElement

store = core.dataStore.commentStore
uiState = core.dataStore.uiState

export class Main extends React.Component
  constructor: (props) ->
    super props

    @pagination = React.createRef()


  componentDidMount: =>
    pagination = newBody.querySelector('.js-comments-pagination').cloneNode(true)
    @pagination.current.innerHTML = ''
    @pagination.current.appendChild pagination


  render: =>
    el React.Fragment, null,
      el HeaderV4,
        links: @headerLinks()
        linksBreadcrumb: true
        theme: 'comments'

      el Observer, null, () =>
        comments = uiState.comments.topLevelCommentIds.map (id) -> store.comments.get(id)
        div className: 'osu-page osu-page--comments',

          if comments.length < 1
            div className: 'comments__text',
              osu.trans 'comments.index.no_comments'
          else
            for comment in comments
              el Comment,
                key: comment.id
                comment: comment
                expandReplies: false
                showCommentableMeta: true
                linkParent: true
                depth: 0
                modifiers: ['dark']

          div ref: @pagination


  headerLinks: =>
    links = [
      {
        title: osu.trans 'comments.index.nav_title'
        url: laroute.route('comments.index')
      }
    ]

    if @props.user?
      links.push(
        {
          title: @props.user.username
          url: laroute.route('users.show', user: @props.user.id)
        },
        {
          title: osu.trans 'comments.index.nav_comments'
          url: laroute.route('comments.index', user_id: @props.user.id)
        }
      )

    return links
