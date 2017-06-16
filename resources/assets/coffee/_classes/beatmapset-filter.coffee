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
    m: 'mode'
    s: 'status'
    g: 'genre'
    l: 'language'
    e: 'extra'
    r: 'rank'
    q: 'query'
    sort: 'sort'


  @defaults:
    mode: null
    status: 0
    genre: null
    language: null
    extra: ''
    rank: ''
    sort: 'ranked_desc'
    query: ''


  @expand: ['genre', 'language', 'extra', 'rank']
