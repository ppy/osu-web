# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { UserEntryList } from './contest/user-entry-list'

reactTurbolinks.registerPersistent 'admin-contest-user-entry-list', UserEntryList, true, (el) ->
  container: el
  contest: osu.parseJson('json-contest')
  entries: osu.parseJson('json-contest-entries')
