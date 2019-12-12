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
          section: osu.trans 'layout.header.community._'
          subSection: osu.trans 'layout.header.community.comments'
          theme: 'comments'

        div className: 'osu-page osu-page--comment',
          el Comment,
            comment: @comment
            showCommentableMeta: true
            depth: 0
            linkParent: true
            modifiers: ['dark', 'single']


  headerLinks: =>
    [
        {
          title: osu.trans 'comments.index.nav_title'
          url: laroute.route('comments.index')
        }
        {
          title: osu.trans 'comments.show.nav_title'
          url: laroute.route('comments.show', @comment)
        }
    ]
