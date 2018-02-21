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

{br, dd, div, dl, dt, span} = ReactDOMFactories
el = React.createElement


simpleEntry = ({key, value}) ->
  dl className: 'profile-stats__entry',
    dt className: 'profile-stats__key', osu.trans("users.show.stats.#{key}")
    dd className: 'profile-stats__value', value


ProfilePage.Stats = ({stats}) ->
  elements = ['ranked-score', 'accuracy', 'playcount', 'total-score', 'hits', 'max_combo', 'replays-watched']

  rankCountEntry = (name) ->
    rankCount = stats.scoreRanks[name]

    div
      className: 'profile-stats__rank'
      div
        className: "badge-rank badge-rank--small badge-rank--#{name}"
      div null, rankCount.toLocaleString()

  playtime = moment.duration stats.play_time, 'seconds'

  div className: 'profile-stats',
    div className: 'profile-stats__row profile-stats__row--compact profile-stats__row--playtime',
      div className: 'profile-badge profile-badge--level',
        span className: 'profile-badge__number', stats.level.current
      div className: 'profile-stats__stat-box profile-stats__stat-box--playtime',
        div className: 'profile-stats__key', osu.trans 'users.show.stats.play_time'
        div className: 'profile-stats__playtime',
          span className: 'profile-stats__playtime-main',
            Math.floor playtime.asHours()
            span className: 'profile-stats__playtime-unit',
              osu.transChoice 'common.count.hour_short_unit', Math.floor playtime.asHours()

          playtime.minutes()
          span className: 'profile-stats__playtime-unit',
            osu.transChoice 'common.count.minute_short_unit', playtime.minutes()

          playtime.seconds()
          span className: 'profile-stats__playtime-unit',
            osu.transChoice 'common.count.second_short_unit', playtime.seconds()
      div className: 'profile-stats__stat-box profile-stats__stat-box--experience-bar',
        div className: 'bar bar--user-profile',
          div
            className: 'bar__fill'
            style:
              width: "#{stats.level.progress}%"
        div className: 'profile-stats__value profile-stats__value--level-progress', "#{stats.level.progress}%"

    div className: 'profile-stats__row',
      simpleEntry
        key: 'ranked_score'
        value: stats.ranked_score.toLocaleString()
      simpleEntry
        key: 'hit_accuracy'
        value: "#{stats.hit_accuracy.toFixed(2)}%"
      simpleEntry
        key: 'play_count'
        value: stats.play_count.toLocaleString()
      simpleEntry
        key: 'total_score'
        value: stats.total_score.toLocaleString()
      simpleEntry
        key: 'total_hits'
        value: stats.total_hits.toLocaleString()
      simpleEntry
        key: 'maximum_combo'
        value: stats.maximum_combo.toLocaleString()
      simpleEntry
        key: 'replays_watched_by_others'
        value: stats.replays_watched_by_others.toLocaleString()

      div className: 'profile-stats__value profile-stats__value--score-ranks',
        rankCountEntry('XH')
        rankCountEntry('X')
        br()
        rankCountEntry('SH')
        rankCountEntry('S')
        rankCountEntry('A')
