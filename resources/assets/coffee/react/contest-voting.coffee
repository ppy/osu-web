# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { ArtEntryList } from './contest-voting/art-entry-list'
import { EntryList } from './contest-voting/entry-list'

propsFunction = (target) ->
  data = osu.parseJson target.dataset.src

  return {
    contest: data.contest
    selected: data.userVotes
    options:
      showPreview: data.contest['type'] == 'music'
      showLink: data.contest['type'] == 'beatmap' && _.some(data.contest.entries, 'preview')
  }

reactTurbolinks.register 'contestArtList', ArtEntryList, propsFunction
reactTurbolinks.register 'contestList', EntryList, propsFunction
