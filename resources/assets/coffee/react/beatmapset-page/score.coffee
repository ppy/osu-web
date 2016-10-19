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

BeatmapsetPage.Score = React.createClass
  mixins: [React.addons.PureRenderMixin]

  render: ->
    hits = Hits.generate score: @props.score, playmode: @props.playmode

    div className: 'beatmapset-score',
      div className: 'beatmapset-score__element beatmapset-score__element--position',
        "##{@props.position}"

      div className: 'beatmapset-score__element beatmapset-score__element--flag',
        if @props.score.user.data.country
          el FlagCountry,
            country: @props.countries[@props.score.user.data.country]
            classModifiers: ['scoreboard']

      div className: 'beatmapset-score__element beatmapset-score__element--player',
        a
          href: laroute.route 'users.show', users: @props.score.user.data.id
          @props.score.user.data.username

      div className: 'beatmapset-score__element beatmapset-score__element--mods',
        el Mods,
          mods: @props.score.mods
          modifiers: ['small', 'reversed']

      div className: 'beatmapset-score__element beatmapset-score__element--rank',
        div className: "badge-rank badge-rank--#{@props.score.rank}"

      div className: 'beatmapset-score__stat beatmapset-score__stat--score',
        @props.score.score.toLocaleString()

      div className: 'beatmapset-score__stat beatmapset-score__stat--accuracy hidden-xs',
        "#{_.round @props.score.accuracy * 100, 2}%"

      div className: 'beatmapset-score__stat beatmapset-score__stat--hits hidden-xs',
        hits.values
