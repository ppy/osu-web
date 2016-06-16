###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
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
    elements = ['ranked-score', 'accuracy', 'playcount', 'total-score', 'hits', 'maxcombo', 'replays-watched']

    el 'div', className: 'page-contents__content profile-stats',
      el 'div', className: 'page-contents__row page-contents__row--top',
        el 'div', className: 'profile-badge profile-badge--level',
          el 'span', className: 'profile-badge__number', @props.stats.level.current

        el 'div', className: 'profile-exp-bar',
          el 'div',
            className: 'profile-exp-bar--fill'
            style:
              width: "#{@props.stats.level.progress.toFixed()}%"

        el 'dl', className: 'profile-stats__stat',
          el 'dt', className: 'profile-stats__stat-key',
            Lang.get 'users.show.stats.level', level: @props.stats.level.current
          el 'dd', className: 'profile-stats__stat-value, profile-stats__stat-value--light',
            "#{@props.stats.level.progress.toFixed()}"

      el 'div', className: 'page-contents__row',
        elements.map (m) =>
          switch m
            when 'ranked-score'
              dt = Lang.get 'users.show.stats.ranked_score'
              dd = @props.stats.rankedScore.toLocaleString()
            when 'accuracy'
              dt = Lang.get 'users.show.stats.hit_accuracy'
              dd = "#{@props.stats.hitAccuracy.toFixed(2)}%"
            when 'playcount'
              dt = Lang.get 'users.show.stats.play_count'
              dd = @props.stats.playCount.toLocaleString()
            when 'total-score'
              dt = Lang.get 'users.show.stats.total_score'
              dd = @props.stats.totalScore.toLocaleString()
            when 'hits'
              dt = Lang.get 'users.show.stats.total_hits'
              dd = @props.stats.totalHits.toLocaleString()
            when 'maxcombo'
              dt = Lang.get 'users.show.stats.maximum_combo'
              dd = @props.stats.maximumCombo.toLocaleString()
            when 'replays-watched'
              dt = Lang.get 'users.show.stats.replays_watched_by_others'
              dd = @props.stats.replaysWatchedByOthers.toLocaleString()

          el 'dl', key: m, className: 'profile-stats__stat',
            el 'dt', className: 'profile-stats__stat-key', dt
            el 'dd', className: 'profile-stats__stat-value', dd

        el 'dl', className: 'profile-stats__stat profile-stats__stat--full',
          el 'dt', className: 'profile-stats__stat-key', Lang.get 'users.show.stats.score_ranks'
          el 'dd', className: 'profile-stats__stat-value profile-stats__ranks',
            for own rankName, rankCount of @props.stats.scoreRanks
              el 'div',
                key: "rank-#{rankName}"
                className: 'profile-stats__rank'
                el 'div',
                  className: "badge-rank badge-rank--medium badge-rank--#{rankName}"
                el 'div', null, rankCount.toLocaleString()
