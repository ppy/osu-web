# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class window.Hits
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
