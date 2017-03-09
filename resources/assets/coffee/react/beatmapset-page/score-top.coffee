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

{div, a} = React.DOM
el = React.createElement
bn = 'beatmap-score-top'

BeatmapsetPage.ScoreTop = React.createClass
  mixins: [React.addons.PureRenderMixin]

  render: ->
    topClasses = (@props.modifiers ? [])
      .map (m) -> "#{bn}--#{m}"
      .join ' '

    hits = Hits.generate score: @props.score, playmode: @props.playmode

    div className: "#{bn} #{topClasses}",
      div className: "#{bn}__section #{bn}__section--top",
        div
          className: "#{bn}__avatar"
          div
            className: "avatar avatar--full"
            style:
              backgroundImage: "url(#{@props.score.user.avatarUrl})"

        div className: "#{bn}__user-box",
          a
            className: "#{bn}__username"
            href: laroute.route 'users.show', user: @props.score.user.id
            @props.score.user.username

          el FlagCountry,
            country: @props.countries[@props.score.user.country]
            classModifiers: ['scoreboard']

        div className: "#{bn}__position",
          "##{@props.position}"
          div className: "#{bn}__achieved",
            osu.trans 'beatmapsets.show.scoreboard.achieved', when: moment(@props.score.created_at).fromNow()

      div className: "#{bn}__section #{bn}__section--bottom",
        div className: "#{bn}__stats-top",
          div className: "#{bn}__rank",
            div className: "badge-rank badge-rank--medium badge-rank--#{@props.score.rank}"

          div className: "#{bn}__stats",
            div className: "#{bn}__stat",
              div className: "#{bn}__stat-header",
                osu.trans 'beatmapsets.show.scoreboard.stats.score'
              div className: "#{bn}__stat-value #{bn}__stat-value--score",
                @props.score.score.toLocaleString()

            div className: "#{bn}__stat",
              div className: "#{bn}__stat-header",
                osu.trans 'beatmapsets.show.scoreboard.stats.accuracy'
              div className: "#{bn}__stat-value #{bn}__stat-value--score",
                "#{_.round @props.score.accuracy * 100, 2}%"

            div className: "#{bn}__stat",
              div className: "#{bn}__stat-header",
                hits.header
              div className: "#{bn}__stat-value #{bn}__stat-value--score",
                hits.values

        if @props.score.mods.length != 0
          div className: "#{bn}__mods",
            el Mods, mods: @props.score.mods
