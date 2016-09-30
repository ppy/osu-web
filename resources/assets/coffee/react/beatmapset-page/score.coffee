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

BeatmapsetPage.Score = (props) ->
  div className: 'beatmapset-score',
    for elem in ['position', 'flag', 'player', 'mods', 'rank', 'score', 'accuracy', 'hits']
      className = "beatmapset-score__element beatmapset-score__element--#{elem}"
      className += ' hidden-xs' if elem == 'hits' || elem == 'accuracy'

      contents =
        switch elem
          when 'position'
            "##{props.position}"
          when 'flag'
            if props.score.user.data.country
              el FlagCountry,
                country: props.countries[props.score.user.data.country]
                classModifiers: ['scoreboard']
          when 'player'
            a
              href: laroute.route 'users.show', users: props.score.user.data.id
              props.score.user.data.username
          when 'mods'
            el Mods,
              mods: props.score.mods
              classModifiers: ['small', 'reversed']
          when 'rank'
            div className: "badge-rank badge-rank--#{props.score.rank}"
          when 'score'
            props.score.score.toLocaleString()
          when 'accuracy'
            "#{_.round props.score.accuracy * 100, 2}%"
          when 'hits'
            hits = Hits.generate score: props.score, playmode: props.playmode
            hits.values

      div className: className, key: elem, contents
