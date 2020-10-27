# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { CommentsManager } from 'comments-manager'
import core from 'osu-core-singleton'
import { Main } from './comments-show/main'

reactTurbolinks.registerPersistent 'comments-show', CommentsManager, true, ->
  commentBundle = osu.parseJson('json-show')
  core.dataStore.updateWithCommentBundleJson(commentBundle)
  core.dataStore.uiState.initializeWithCommentBundleJson(commentBundle)

  component: Main
