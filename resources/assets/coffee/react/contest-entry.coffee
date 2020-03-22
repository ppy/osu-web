# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { UserEntryList } from './contest-entry/user-entry-list'

propsFunction = ->
  data = osu.parseJson('json-contest')
  userEntries = osu.parseJson('json-userEntries')
  return {
    contest: data.contest
    userEntries: userEntries
  }

reactTurbolinks.register 'userContestEntry', UserEntryList, propsFunction
