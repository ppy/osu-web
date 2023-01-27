# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute'
import { defaultBeatmapId, defaultMode, stateFromDiscussion, urlParse } from 'utils/beatmapset-discussion-helper'
import { currentUrl } from 'utils/turbolinks'
import { getInt } from 'utils/math'

class window.BeatmapDiscussionHelper
  @DEFAULT_FILTER: 'total'
