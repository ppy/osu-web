###
#    Copyright 2015-2017 ppy Pty. Ltd.
#
#    This file is part of osu!web. osu!web is distributed with the hope of
#    attracting more community contributions to the core ecosystem of osu!.
#
#    osu!web is free software: you can redistribute it and/or modify
#    it under the terms of the Affero GNU General Public License version 3
#    as published by the Free Software Foundation.
#
#    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
#    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
#    See the GNU Affero General Public License for more details.
#
#    You should have received a copy of the GNU Affero General Public License
#    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###

parseInt10 = (string) ->
  int = parseInt string, 10

  if _.isFinite(int) then int else null


class @BeatmapsetFilter
  @castFromString:
    mode: parseInt10
    status: parseInt10
    genre: parseInt10
    language: parseInt10


  @charToKey:
    c: 'general'
    m: 'mode'
    s: 'status'
    g: 'genre'
    l: 'language'
    e: 'extra'
    r: 'rank'
    played: 'played'
    q: 'query'
    sort: 'sort'


  @keyToChar: ->
    @_keyToChar ?= _.invert @charToKey


  @defaults:
    general: ''
    extra: ''
    genre: null
    language: null
    mode: null
    played: null
    query: ''
    rank: ''
    status: 0


  @expand: ['genre', 'language', 'extra', 'rank', 'played']

  @fillDefaults: (filters) =>
    ret = {}

    for key in @keys
      ret[key] = filters[key] ? @getDefault(filters, key)

    ret


  @getDefault: (filters, key) =>
    return @defaults[key] if @defaults.hasOwnProperty(key)

    if key == 'sort'
      if filters.query?.trim().length > 0
        'relevance_desc'
      else
        if filters.status in [4, 5, 6]
          'updated_desc'
        else
          'ranked_desc'


  @getDefaults: (filters) =>
    ret = {}

    for key in @keys
      ret[key] = @getDefault(filters, key)

    ret


  @keys: [
    'general'
    'extra'
    'genre'
    'language'
    'mode'
    'played'
    'query'
    'rank'
    'sort'
    'status'
  ]

  @queryParamsFromFilters: (filters) ->
    return {} if !currentUser.id?

    charParams = {}

    for own key, value of filters
      if value? && @getDefault(filters, key) != value
        charParams[@keyToChar()[key]] = value

    charParams
