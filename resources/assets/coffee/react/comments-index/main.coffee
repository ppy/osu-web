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

import { Comment } from 'comment'
import HeaderV4 from 'header-v4'
import { Observer } from 'mobx-react'
import core from 'osu-core-singleton'
import * as React from 'react'
import { button, div, h1, p, span } from 'react-dom-factories'

el = React.createElement

store = core.dataStore.commentStore
uiState = core.dataStore.uiState

export class Main extends React.Component
  constructor: (props) ->
    super props

    @pagination = React.createRef()


  componentDidMount: =>
    pagination = document.querySelector('.js-comments-pagination').cloneNode(true)
    @pagination.current.innerHTML = ''
    @pagination.current.appendChild pagination


  render: =>
    el React.Fragment, null,
      el HeaderV4,
        links: @headerLinks()
        linksBreadcrumb: true
        section: osu.trans 'layout.header.community._'
        subSection: osu.trans 'layout.header.community.comments'
        theme: 'comments'

      el Observer, null, () =>
        comments = uiState.comments.topLevelCommentIds.map (id) -> store.comments.get(id)
        div className: 'osu-page osu-page--comments',
          for comment in comments
            el Comment,
              key: comment.id
              comment: comment
              showReplies: false
              showCommentableMeta: true
              linkParent: true
              depth: 0
              modifiers: ['dark']

          div ref: @pagination


  headerLinks: ->
    [
      {
        title: osu.trans 'comments.index.nav_title'
        url: laroute.route('comments.index')
      }
    ]
