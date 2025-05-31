# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton'
import { createElement } from 'react'
import { parseJson } from 'utils/json'
import { ArtEntryList } from 'contest-voting/art-entry-list'
import { EntryList } from 'contest-voting/entry-list'

propsFunction = (container) ->
  data = parseJson container.dataset.src

  return {
    contest: data.contest
    selected: data.userVotes
    stdRange:
      max: _.maxBy(data.contest.entries, 'results.score_std')?.results.score_std
      min: _.minBy(data.contest.entries, 'results.score_std')?.results.score_std
    options:
      showPreview: data.contest['type'] == 'music'
      showLink: data.contest['type'] == 'external' || (data.contest['type'] == 'beatmap' && _.some(data.contest.entries, 'preview'))
  }

core.reactTurbolinks.register 'contestArtList', (container) ->
  createElement(ArtEntryList, propsFunction(container))

core.reactTurbolinks.register 'contestList', (container) ->
  createElement(EntryList, propsFunction(container))
