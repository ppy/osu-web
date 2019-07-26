###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
    if items?
      return _.findLast(items, (i) -> !i.deleted_at? && !i.convert) ? _.last(items)

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
    if rating < 2
      'easy'
    else if rating < 2.7
      'normal'
    else if rating < 4
      'hard'
    else if rating < 5.3
      'insane'
    else if rating < 6.5
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
    if beatmaps[0].mode == 'mania'
      _.orderBy beatmaps, ['convert', 'cs', 'difficulty_rating'], ['desc', 'asc', 'asc']
    else
      _.orderBy beatmaps, ['convert', 'difficulty_rating'], ['desc', 'asc']
