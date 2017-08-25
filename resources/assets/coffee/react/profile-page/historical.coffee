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

{a, div, h2, h3, img, p, small, span} = ReactDOMFactories
el = React.createElement

class ProfilePage.Historical extends React.PureComponent
  render: =>
    div
      className: 'page-extra'

      el ProfilePage.ExtraHeader, name: @props.name, withEdit: @props.withEdit

      h3
        className: 'page-extra__title page-extra__title--small'
        osu.trans('users.show.extra.historical.most_played.title')

      if @props.beatmapPlaycounts?.length
        [
          @props.beatmapPlaycounts.map (pc, i) =>
            @_beatmapRow pc.beatmap, pc.beatmapset, i, [
              [
                span
                  key: 'name'
                  className: 'beatmapset-row__info'
                  osu.trans('users.show.extra.historical.most_played.count')
                span
                  key: 'value'
                  className: 'beatmapset-row__info beatmapset-row__info--large'
                  " #{pc.count.toLocaleString()}"
              ]
            ]
          span
            key: 'show-more-row'
            className: 'beatmapset-row beatmapset-row--more'
            el ProfilePage.ShowMoreLink,
              propertyName: 'beatmapPlaycounts'
              pagination: @props.pagination
              route: laroute.route 'users.beatmapsets',
                  user: @props.user.id
                  type: 'most_played'
        ]

      else
        p null, osu.trans('users.show.extra.historical.empty')

      h3
        className: 'page-extra__title page-extra__title--small'
        osu.trans('users.show.extra.historical.recent_plays.title')

      if @props.scoresRecent?.length
        [
          @props.scoresRecent.map (score, i) =>
            el PlayDetail, key: i, score: score

          span
            key: 'show-more-row'
            className: 'beatmapset-row beatmapset-row--more'
            el ProfilePage.ShowMoreLink,
              propertyName: 'scoresRecent'
              pagination: @props.pagination
              route: laroute.route 'users.scores',
                  user: @props.user.id
                  type: 'recent'
                  mode: @props.currentMode
        ]

      else
        p null, osu.trans('users.show.extra.historical.empty')


  _beatmapRow: (bm, bmset, key, details = []) =>
    div
      key: key
      className: 'beatmapset-row'
      div
        className: 'beatmapset-row__cover'
        style:
          backgroundImage: "url('#{bmset.covers.list}')"
      div
        className: 'beatmapset-row__detail'
        div
          className: 'beatmapset-row__detail-row'
          div
            className: 'beatmapset-row__detail-column beatmapset-row__detail-column--full'
            a
              className: 'beatmapset-row__title'
              href: laroute.route 'beatmaps.show', beatmap: bm.id
              title: "#{bmset.artist} - #{bmset.title} [#{bm.version}] "
              "#{bmset.title} [#{bm.version}] "
              span
                className: 'beatmapset-row__title-small'
                bmset.artist
          div
            className: 'beatmapset-row__detail-column'
            details[0]
        div
          className: 'beatmapset-row__detail-row'
          div
            className: 'beatmapset-row__detail-column beatmapset-row__detail-column--full'
            span dangerouslySetInnerHTML:
                __html: osu.trans 'beatmaps.listing.mapped-by',
                  mapper: laroute.link_to_route 'users.show',
                    bmset.creator
                    { user: bmset.user_id }
                    class: 'beatmapset-row__title-small'
          div
            className: 'beatmapset-row__detail-column'
            details[1]