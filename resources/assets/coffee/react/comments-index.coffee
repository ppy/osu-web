# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { CommentsManager } from 'comments-manager'
import core from 'osu-core-singleton'
import { createElement } from 'react'
import { Main } from './comments-index/main'

core.reactTurbolinks.register 'comments-index', true, ->
  commentBundle = osu.parseJson('json-index')
  core.dataStore.updateWithCommentBundleJson(commentBundle)
  core.dataStore.uiState.initializeWithCommentBundleJson(commentBundle)

  createElement CommentsManager,
    component: Main
    user: commentBundle.user
