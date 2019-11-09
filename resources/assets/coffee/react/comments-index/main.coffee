###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

import { Comment } from 'comment'
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
    div null,
      div className: 'header-v3 header-v3--comments',
        div className: 'header-v3__bg'
        div className: 'header-v3__overlay'
        div className: 'osu-page osu-page--header-v3',
          @renderHeaderTitle()
          @renderHeaderTabs()

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


  renderHeaderTabs: =>
    div className: 'page-mode-v2 page-mode-v2--comments',
      span
        className: 'page-mode-v2__link page-mode-v2__link--active'
        osu.trans 'comments.index.title.info'


  renderHeaderTitle: =>
    div className: 'osu-page-header-v3 osu-page-header-v3--comments',
      div className: 'osu-page-header-v3__title',
        div className: 'osu-page-header-v3__title-icon',
          div className: 'osu-page-header-v3__icon'
        h1
          className: 'osu-page-header-v3__title-text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'comments.index.title._',
              info: "<span class='osu-page-header-v3__title-highlight'>#{osu.trans('comments.index.title.info')}</span>"
