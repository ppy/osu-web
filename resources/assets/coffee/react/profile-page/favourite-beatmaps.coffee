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

{div} = ReactDOMFactories
el = React.createElement

class ProfilePage.FavouriteBeatmaps extends React.PureComponent
  render: ->
    div
      className: 'page-extra'
      el ProfilePage.ExtraHeader,
        text: osu.trans 'users.show.extra.favourite_beatmaps.header', count: @props.count
        withEdit: @props.withEdit

      if @props.beatmapsets.length > 0
        div className: 'osu-layout__col-container osu-layout__col-container--with-gutter',
          for beatmapset in @props.beatmapsets
            div
              key: beatmapset.id
              className: 'osu-layout__col osu-layout__col--sm-6'
              el BeatmapsetPanel, beatmap: beatmapset

          div
            className: 'osu-layout__col text-center',
            el ProfilePage.ShowMoreLink,
              collection: @props.beatmapsets
              propertyName: 'favouriteBeatmapsets'
              pagination: @props.pagination.favouriteBeatmapsets
              perPage: 6
              maxResults: @props.count
              route: laroute.route 'users.beatmapsets',
                user: @props.user.id
                type: 'favourite'

      else
        p className: 'page-extra-entries', osu.trans 'users.show.extra.beatmaps.none'
