# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Comment } from 'comment'
import HeaderV4 from 'header-v4'
import { route } from 'laroute'
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
      @comment = store.comments.get(uiState.comments.topLevelCommentIds[0])

      el React.Fragment, null,
        el HeaderV4,
          links: @headerLinks()
          linksBreadcrumb: true
          theme: 'comments'

        div className: 'osu-page osu-page--comment',
          el Comment,
            comment: @comment
            showCommentableMeta: true
            showToolbar: true
            depth: 0
            linkParent: true
            modifiers: ['dark', 'single']


  headerLinks: =>
    [
        {
          title: osu.trans 'comments.index.nav_title'
          url: route('comments.index')
        }
        {
          title: osu.trans 'comments.show.nav_title'
          url: route('comments.show', @comment)
        }
    ]
