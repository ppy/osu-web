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

{dd, div, dl, dt, span} = React.DOM
el = React.createElement


simpleEntry = ({key, value}) ->
  dl className: 'profile-stats__entry',
    dt className: 'profile-stats__key', osu.trans("users.show.stats.#{key}")
    dd className: 'profile-stats__value', value


ProfilePage.Stats = ({stats}) ->
  elements = ['ranked-score', 'accuracy', 'playcount', 'total-score', 'hits', 'maxcombo', 'replays-watched']

  div className: 'profile-stats',
    div className: 'profile-stats__row profile-stats__row--compact',
      div className: 'profile-badge profile-badge--level',
        span className: 'profile-badge__number', stats.level.current

    div className: 'profile-stats__row',
      simpleEntry
        key: 'ranked_score'
        value: stats.rankedScore.toLocaleString()
      simpleEntry
        key: 'hit_accuracy'
        value: "#{stats.hitAccuracy.toFixed(2)}%"
      simpleEntry
        key: 'play_count'
        value: stats.playCount.toLocaleString()
      simpleEntry
        key: 'total_score'
        value: stats.totalScore.toLocaleString()
      simpleEntry
        key: 'total_hits'
        value: stats.totalHits.toLocaleString()
      simpleEntry
        key: 'maximum_combo'
        value: stats.maximumCombo.toLocaleString()
      simpleEntry
        key: 'replays_watched_by_others'
        value: stats.replaysWatchedByOthers.toLocaleString()

      dl className: 'profile-stats__entry profile-stats__entry--full',
        dt className: 'profile-stats__key', osu.trans 'users.show.stats.score_ranks'
        dd className: 'profile-stats__value',
          for own rankName, rankCount of stats.scoreRanks
            div
              key: "rank-#{rankName}"
              className: 'profile-stats__rank'
              div
                className: "badge-rank badge-rank--medium badge-rank--#{rankName}"
              div null, rankCount.toLocaleString()
