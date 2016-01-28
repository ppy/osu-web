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

{div, h2, h3, ul, li, a, p, pre, span} = React.DOM
el = React.createElement

ProfilePage.Beatmaps = React.createClass
  mixins: [React.addons.PureRenderMixin]

  render: ->
    beatmaps =
      'favourite': @props.favouriteBeatmapSets?.data || [],
      'ranked_and_approved': @props.rankedAndApprovedBeatmapSets?.data || []

    div
      className: 'osu-layout__row osu-layout__row--page profile-extra'
      div className: 'profile-extra__anchor js-profile-page-extra--scrollspy', id: 'beatmaps'
      h2 className: 'profile-extra__title', Lang.get('users.show.extra.beatmaps.title')
      ['favourite', 'ranked_and_approved'].map (section) ->
        div null,
          h3 className: 'profile-extra__title--small', Lang.get("users.show.extra.beatmaps.#{section}.title", count: beatmaps[section].length)
          if beatmaps[section].length
            div className: 'beatmap-container',
              div className: 'listing',
                beatmaps[section].map (beatmap) ->
                  el(Panel, beatmap: beatmap, key: beatmap.beatmapset_id)
          else
            p className: 'profile-extra-entries', Lang.get('users.show.extra.beatmaps.none')
