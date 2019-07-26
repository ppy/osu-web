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

class @Hits
  @generate: ({score, playmode}) ->
    elements = if playmode == 'mania'
      ['count_geki', 'count_300',  'count_katu', 'count_100', 'count_50']
    else
      ['count_300', 'count_100', 'count_50']

    header:
      elements
        .map (elem) -> osu.trans "common.score_count.#{elem}"
        .join '/'
    values:
      elements
        .map (elem) -> osu.formatNumber(score.statistics[elem])
        .join '/'
