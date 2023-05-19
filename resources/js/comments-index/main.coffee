# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import Comment from 'components/comment'
import HeaderV4 from 'components/header-v4'
import { route } from 'laroute'
import { observer } from 'mobx-react'
import core from 'osu-core-singleton'
import * as React from 'react'
import { a, button, div, h1, p, span } from 'react-dom-factories'
import { trans } from 'utils/lang'

el = React.createElement

store = core.dataStore.commentStore
uiState = core.dataStore.uiState

class BaseMain extends React.Component
  render: =>
    comments = uiState.comments.topLevelCommentIds.map (id) -> store.comments.get(id)
    if comments.length < 1
      div className: 'comments',
        div className: 'comments__items comments__items--empty',
          trans 'comments.index.no_comments'
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

export default Main = observer(BaseMain)
