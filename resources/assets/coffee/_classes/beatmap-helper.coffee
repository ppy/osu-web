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

class @BeatmapHelper
  @default: ({group, items, mode}) =>
    return _.last(items) if items?

    return unless group?

    modes = if mode? then [mode] else @modes
    for mode in modes
      beatmap = @default items: group[mode]

      return beatmap if beatmap?


  @find: ({group, id, mode}) =>
    modes = if mode? then [mode] else @modes
    for mode in modes
      item = _.find group[mode], id: id

      return item if item?


  @getDiffRating: (rating) ->
    if rating < 1.5
      'easy'
    else if rating < 2.25
      'normal'
    else if rating < 3.75
      'hard'
    else if rating < 5.25
      'insane'
    else if rating < 6.75
      'expert'
    else
      'expert-plus'


  @group: (beatmaps) =>
    grouped = _.groupBy beatmaps, 'mode'
    for own mode, items of grouped
      grouped[mode] = @sort items

    grouped


  @modes: ['osu', 'taiko', 'fruits', 'mania']


  @sort: (beatmaps) ->
    sortBy = ['convert', 'difficulty_rating']

    if beatmaps[0].mode == 'mania'
      sortBy.unshift 'cs'

    _.sortBy beatmaps, sortBy
