# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

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


  @charToKey:
    c: 'general'
    e: 'extra'
    g: 'genre'
    l: 'language'
    m: 'mode'
    nsfw: 'nsfw'
    played: 'played'
    q: 'query'
    r: 'rank'
    s: 'status'
    sort: 'sort'


  @filtersFromUrl: (url) ->
    params = new URL(url).searchParams

    filters = {}

    for own char, key of @charToKey
      value = params.get(char)

      continue if !value? || value.length == 0

      value = @castFromString[key](value) if @castFromString[key]
      filters[key] = value

    filters


  @keyToChar: ->
    @_keyToChar ?= _.invert @charToKey


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


  @expand: ['genre', 'language', 'extra', 'rank', 'played']

  @fillDefaults: (filters) =>
    ret = {}

    for key in @keys
      ret[key] = filters[key] ? @getDefault(filters, key)

    ret


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


  @getDefaults: (filters) =>
    ret = {}

    for key in @keys
      ret[key] = @getDefault(filters, key)

    ret


  # TODO: look at combining with the one in beatmapset-search-filter.ts
  @keys: [
    'general'
    'extra'
    'genre'
    'language'
    'mode'
    'nsfw'
    'played'
    'query'
    'rank'
    'sort'
    'status'
  ]

  @queryParamsFromFilters: (filters) ->
    charParams = {}

    for own key, value of filters
      if value? && @getDefault(filters, key) != value
        charParams[@keyToChar()[key]] = value

    charParams


  # For UI purposes; server-side has its own check.
  @supporterRequired: (filters) ->
    _.reject ['played', 'rank'], (name) =>
      _.isEmpty(filters[name]) || filters[name] == @getDefault(filters, name)
