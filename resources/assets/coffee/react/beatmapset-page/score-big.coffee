###
# Copyright 2015-2016 ppy Pty. Ltd.
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
{div, a} = React.DOM
el = React.createElement

BeatmapsetPage.ScoreBig = React.createClass
  mixins: [React.addons.PureRenderMixin]

  render: ->
    className = 'beatmapset-score-big'
    classNamePosition = 'beatmapset-score-big__position'

    if @props.position == 1
      className += ' beatmapset-score-big--first-score'
      classNamePosition += ' beatmapset-score-big__position--first-score'

    classNamePosition += ' beatmapset-score-big__position--not-top-score' if @props.position > 50

    div className: className,
      div className: 'beatmapset-score-big__section beatmapset-score-big__section--top',
        div className: classNamePosition, "##{@props.position}"
        div
          className: 'beatmapset-score-big__avatar avatar avatar--beatmapset-scoreboard hidden-xs'
          style:
            backgroundImage: "url(#{@props.score.user.data.avatarUrl})"

        div className: 'beatmapset-score-big__user-box',
          a
            className: 'beatmapset-score-big__username'
            href: laroute.route 'users.show', users: @props.score.user.data.id
            @props.score.user.data.username

          el FlagCountry,
            country: @props.countries[@props.score.user.data.country]
            classModifiers: ['scoreboard']

        div className: 'beatmapset-score-big__stats-box',
          el Mods,
            mods: @props.score.mods
            classModifiers: ['reversed']

          div className: 'beatmapset-score-big__rank',
            div className: "badge-rank badge-rank--#{@props.score.rank}"

          for elem in ['score', 'accuracy', 'hits']
            className = 'beatmapset-score-big__stat'
            className += ' hidden-xs' if elem != 'score'

            switch elem
              when 'score'
                header = osu.trans 'beatmaps.beatmapset.show.scoreboard.stats.score'
                value = @props.score.score.toLocaleString()
              when 'accuracy'
                header = osu.trans 'beatmaps.beatmapset.show.scoreboard.stats.accuracy'
                value = "#{_.round @props.score.accuracy * 100, 2}%"
              when 'hits'
                hits = Hits.generate score: @props.score, playmode: @props.playmode

                header = hits.header
                value = hits.values

            div className: className, key: elem,
              div className: 'beatmapset-score-big__stat-header', header
              div className: 'beatmapset-score-big__stat-value beatmapset-score-big__stat-value--score', value

      div className: 'beatmapset-score-big__section beatmapset-score-big__section--bottom',
        div className: 'beatmapset-score-big__achieved',
          osu.trans 'beatmaps.beatmapset.show.scoreboard.achieved', when: moment(@props.score.created_at).fromNow()
