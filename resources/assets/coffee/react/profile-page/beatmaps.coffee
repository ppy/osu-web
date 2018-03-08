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

{div, h2, h3, ul, li, a, p, pre, span} = ReactDOMFactories
el = React.createElement

class ProfilePage.Beatmaps extends React.PureComponent
  render: =>
    allBeatmapsets =
      favouriteBeatmapsets: @props.favouriteBeatmapsets
      rankedAndApprovedBeatmapsets: @props.rankedAndApprovedBeatmapsets
      unrankedBeatmapsets: @props.unrankedBeatmapsets
      graveyardBeatmapsets: @props.graveyardBeatmapsets

    div
      className: 'page-extra'
      el ProfilePage.ExtraHeader, name: @props.name, withEdit: @props.withEdit
      for own section, beatmapsets of allBeatmapsets
        sectionSnaked = _.replace(_.snakeCase(section), '_beatmapsets', '')
        div
          key: section
          h3
            className: 'page-extra__title page-extra__title--small'
            osu.trans("users.show.extra.beatmaps.#{sectionSnaked}.title", count: @props.counts[section])

          if beatmapsets.length > 0
            div className: 'osu-layout__col-container osu-layout__col-container--with-gutter',
              for beatmapset in beatmapsets
                div
                  key: beatmapset.id
                  className: 'osu-layout__col osu-layout__col--sm-6'
                  el BeatmapsetPanel, beatmap: beatmapset

              div
                className: 'osu-layout__col',
                el ProfilePage.ShowMoreLink,
                  collection: beatmapsets
                  propertyName: section
                  pagination: @props.pagination[section]
                  route: laroute.route 'users.beatmapsets',
                    user: @props.user.id
                    type: sectionSnaked

          else
            p className: 'page-extra-entries', osu.trans('users.show.extra.beatmaps.none')
