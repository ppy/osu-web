# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Main } from 'comments-show/main'
import { CommentsManager } from 'components/comments-manager'
import core from 'osu-core-singleton'
import { createElement } from 'react'
import { parseJson } from 'utils/json'

core.reactTurbolinks.register 'comments-show', ->
  commentBundle = parseJson('json-show')
  core.dataStore.updateWithCommentBundleJson(commentBundle)
  core.dataStore.uiState.initializeWithCommentBundleJson(commentBundle)

  createElement CommentsManager,
    component: Main
