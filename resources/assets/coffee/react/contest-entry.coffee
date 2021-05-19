# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton'
import { createElement } from 'react'
import { UserEntryList } from './contest-entry/user-entry-list'

core.reactTurbolinks.register 'userContestEntry', false, ->
  data = osu.parseJson('json-contest')
  userEntries = osu.parseJson('json-userEntries')

  createElement UserEntryList,
    contest: data.contest
    userEntries: userEntries
