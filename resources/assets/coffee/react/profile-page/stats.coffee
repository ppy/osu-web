###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
el = React.createElement

class ProfilePage.Stats extends React.Component
  render: =>
    el 'div', className: 'profile-content flex-col-33',
      el 'div', className: 'profile-row profile-row--top',
        el 'div', className: 'profile-top-badge profile-level-badge',
          el 'span', className: 'profile-badge-number', @props.stats.level.current

        el 'div', className: 'profile-exp-bar',
          el 'div',
            className: 'profile-exp-bar-fill'
            style:
              width: "#{@props.stats.level.progress.toFixed()}%"

        el 'dl', className: 'profile-stats profile-stats--light',
          el 'dt', null,
            Lang.get('users.show.stats.level', level: @props.stats.level.current)
          el 'dd', null, "#{@props.stats.level.progress.toFixed()}%"

      el 'div', className: 'profile-row',
        el 'dl', className: 'profile-stats',
          el 'dt', null, Lang.get('users.show.stats.ranked_score')
          el 'dd', null, @props.stats.rankedScore.toLocaleString()

        el 'dl', className: 'profile-stats',
          el 'dt', null, Lang.get('users.show.stats.hit_accuracy')
          el 'dd', null, "#{@props.stats.hitAccuracy.toFixed(2)}%"

        el 'dl', className: 'profile-stats',
          el 'dt', null, Lang.get('users.show.stats.play_count')
          el 'dd', null, @props.stats.playCount.toLocaleString()

        el 'dl', className: 'profile-stats',
          el 'dt', null, Lang.get('users.show.stats.total_score')
          el 'dd', null, @props.stats.totalScore.toLocaleString()

        el 'dl', className: 'profile-stats',
          el 'dt', null, Lang.get('users.show.stats.total_hits')
          el 'dd', null, @props.stats.totalHits.toLocaleString()

        el 'dl', className: 'profile-stats',
          el 'dt', null, Lang.get('users.show.stats.maximum_combo')
          el 'dd', null, @props.stats.maximumCombo.toLocaleString()

        el 'dl', className: 'profile-stats',
          el 'dt', null, Lang.get('users.show.stats.replays_watched_by_others')
          el 'dd', null, @props.stats.replaysWatchedByOthers.toLocaleString()

        el 'dl', className: 'profile-stats profile-stats--full',
          el 'dt', null, Lang.get('users.show.stats.score_ranks')
          el 'dd', className: 'profile-score-ranks',
            ['ss', 's', 'a'].map (x) =>
              el 'div',
                key: "rank-#{x}"
                className: 'profile-score-rank'
                el 'div',
                  className: "badge-rank badge-rank--#{x}"
                el 'div', null, @props.stats.scoreRanks[x].toLocaleString()
