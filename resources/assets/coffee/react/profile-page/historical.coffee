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
{a, div, h2, h3, img, small, span} = React.DOM
el = React.createElement

ProfilePage.Historical = React.createClass
  mixins: [React.addons.PureRenderMixin]

  getInitialState: ->
    showing: 5

  _showMore: (e) ->
    e.preventDefault() if e

    @setState showing: (@state.showing + 5)


  render: ->
    div
      className: 'profile-extra'
      div className: 'profile-extra__anchor js-profile-page-extra--scrollspy', id: 'historical'

      h2 className: 'profile-extra__title', Lang.get('users.show.extra.historical.title')

      @props.beatmapPlaycounts.map (pc, i) =>
        bm = pc.beatmap.data
        bmset = pc.beatmapSet.data

        topClasses = 'beatmapset-row'
        topClasses += ' hidden' unless i < @state.showing

        div
          key: i
          className: topClasses
          div
            className: 'beatmapset-row__cover'
            style:
              backgroundImage: "url('#{bmset.coverUrl}')"
          div
            className: 'beatmapset-row__detail'
            div
              className: 'beatmapset-row__detail-row'
              div
                className: 'beatmapset-row__detail-column beatmapset-row__detail-column--full'
                a
                  className: 'beatmapset-row__title'
                  href: "/s/#{bmset.beatmapset_id}"
                  title: "#{bmset.title} [#{bm.version}] "
                  "#{bmset.title} [#{bm.version}] "
                  span
                    className: 'beatmapset-row__title-small'
                    bmset.artist
              div
                className: 'beatmapset-row__detail-column'
                span
                  className: 'beatmapset-row__info'
                  Lang.get('users.show.extra.historical.times_played')
                span
                  className: 'beatmapset-row__info beatmapset-row__info--large'
                  " #{pc.count.toLocaleString()}"
            div
              className: 'beatmapset-row__detail-row'
              span dangerouslySetInnerHTML:
                  __html: Lang.get 'beatmaps.listing.mapped-by',
                    mapper: osu.link("/u/#{bmset.user_id}", bmset.creator, classNames: ['beatmapset-row__title-small'])

      if @props.beatmapPlaycounts.length > @state.showing
        a
          href: '#'
          onClick: @_showMore
          Lang.get('common.buttons.show_more')
