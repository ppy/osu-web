###
#  Copyright 2015 ppy Pty. Ltd.
#
#  This file is part of osu!web. osu!web is distributed with the hope of
#  attracting more community contributions to the core ecosystem of osu!.
#
#  osu!web is free software: you can redistribute it and/or modify
#  it under the terms of the Affero GNU General Public License version 3
#  as published by the Free Software Foundation.
#
#  osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
#  warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
#  See the GNU Affero General Public License for more details.
#
#  You should have received a copy of the GNU Affero General Public License
#  along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
#
###

{div, a, span} = React.DOM
el = React.createElement

@PlayDetail = React.createClass
  mixins: [React.addons.PureRenderMixin]

  render: ->
    score = @props.score
    modsText =
      if score.mods.length
        " +#{(mod.shortName for mod in score.mods).join(',')} "
      else
        ' '

    topClasses = 'profile-extra-entries__item profile-extra-entries__item--top-ranks'
    topClasses += ' hidden' unless @props.shown

    title = "#{score.beatmapSet.data.title} [#{score.beatmap.data.version}]#{modsText}(#{(score.accuracy * 100).toFixed(2)}%)"

    div
      className: topClasses
      div
        className: 'profile-extra-entries__icon'
        div className: "badge-rank badge-rank--#{score.rank}"

      div className: 'profile-extra-entries__detail profile-extra-entries__detail--vertical',
        div
          className: 'profile-extra-entries__detail-row'
          div
            className: 'profile-extra-entries__detail-column profile-extra-entries__detail-column--full'
            a
              href: score.beatmap.data.url
              className: 'profile-extra-entries__text-score profile-extra-entries__text-score--title'
              title: title
              title
          div
            className: 'profile-extra-entries__detail-column'
            span
              className: 'profile-extra-entries__text-score profile-extra-entries__text-score--pp'
              Lang.get('users.show.extra.top_ranks.pp', amount: Math.round(score.pp))
        div
          className: 'profile-extra-entries__detail-row'
          div
            className: 'profile-extra-entries__detail-column profile-extra-entries__detail-column--full'
            span
              className: 'profile-extra-entries__text-score profile-extra-entries__text-score--time'
              dangerouslySetInnerHTML:
                __html: osu.timeago score.created_at
          if score.weight != undefined
            div
              className: 'profile-extra-entries__detail-column'
              span
                className: 'profile-extra-entries__text-score'
                Lang.get 'users.show.extra.top_ranks.weighted_pp',
                  percentage: "#{Math.round(score.weight.data.percentage)}%"
                  pp: Lang.get('users.show.extra.top_ranks.pp', amount: Math.round(score.weight.data.pp))
