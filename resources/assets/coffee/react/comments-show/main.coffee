###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

import { Comment } from 'comment'
import { Observer } from 'mobx-react'
import core from 'osu-core-singleton'
import * as React from 'react'
import { a, button, div, h1, li, ol, p, span } from 'react-dom-factories'
el = React.createElement

store = core.dataStore.commentStore
uiState = core.dataStore.uiState

export class Main extends React.PureComponent
  render: =>
    el Observer, null, () =>
      comment = store.comments.get(uiState.comments.topLevelCommentIds[0])

      div null,
        div className: 'header-v3 header-v3--comments',
          div className: 'header-v3__bg'
          div className: 'header-v3__overlay'
          div className: 'osu-page osu-page--header-v3',
            @renderHeaderTitle()
            @renderHeaderTabs()

        div className: 'osu-page osu-page--comment',
          el Comment,
            comment: comment
            showCommentableMeta: true
            depth: 0
            linkParent: true
            modifiers: ['dark', 'single']


  renderHeaderTabs: =>
    ol className: 'page-mode-v2 page-mode-v2--comments',
      li
        className: 'page-mode-v2__item'
        a
          href: laroute.route('comments.index')
          className: 'page-mode-v2__link'
          osu.trans 'comments.index.title.info'
      li
        className: 'page-mode-v2__item'
        span
          className: 'page-mode-v2__link page-mode-v2__link--active'
          osu.trans 'comments.show.title.info'


  renderHeaderTitle: =>
    div className: 'osu-page-header-v3 osu-page-header-v3--comments',
      div className: 'osu-page-header-v3__title',
        div className: 'osu-page-header-v3__title-icon',
          div className: 'osu-page-header-v3__icon'
        h1
          className: 'osu-page-header-v3__title-text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'comments.show.title._',
              info: "<span class='osu-page-header-v3__title-highlight'>#{osu.trans('comments.show.title.info')}</span>"
