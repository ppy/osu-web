# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { charToKey, keyNames, keyToChar } from 'beatmapset-search-filters'

parseBool = (string) ->
  switch string
    when 'false' then false
    when 'true' then true


parseInt10 = (string) ->
  int = parseInt string, 10

  if _.isFinite(int) then int else null


class window.BeatmapsetFilter
  @castFromString:
    genre: parseInt10
    language: parseInt10
    mode: parseInt10
    nsfw: parseBool


  @defaults:
    general: ''
    extra: ''
    genre: null
    language: null
    mode: null
    played: 'any'
    query: ''
    rank: ''
    status: 'leaderboard'


  @getDefault: (filters, key) =>
    return @defaults[key] if @defaults.hasOwnProperty(key)

    switch key
      when 'nsfw'
        osuCore.userPreferences.get('beatmapset_show_nsfw')
      when 'sort'
        if filters.query?.trim().length > 0
          'relevance_desc'
        else
          if filters.status in ['pending', 'wip', 'graveyard', 'mine']
            'updated_desc'
          else
            'ranked_desc'
