###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

import { ExtraHeader } from './extra-header'
import { BeatmapsetPanel } from 'beatmapset-panel'
import * as React from 'react'
import { div, h2, h3, ul, li, a, p, pre, span } from 'react-dom-factories'
import { ShowMoreLink } from 'show-more-link'
el = React.createElement

sections = [
  'favouriteBeatmapsets'
  'rankedAndApprovedBeatmapsets'
  'lovedBeatmapsets'
  'unrankedBeatmapsets'
  'graveyardBeatmapsets'
]

export class Beatmaps extends React.PureComponent
  render: =>
    div
      className: 'page-extra'
      el ExtraHeader, name: @props.name, withEdit: @props.withEdit
      sections.map @renderBeatmapsets


  renderBeatmapsets: (section) =>
    sectionSnaked = _.replace(_.snakeCase(section), '_beatmapsets', '')
    count = @props.counts[section]
    beatmapsets = @props[section]

    div
      key: section
      h3
        className: 'title title--page-extra-small'
        osu.trans("users.show.extra.beatmaps.#{sectionSnaked}.title")
        ' '
        if count > 0
          span
            className: 'title__count'
            osu.formatNumber(count)

      if beatmapsets.length > 0
        div className: 'osu-layout__col-container osu-layout__col-container--with-gutter',
          for beatmapset in beatmapsets
            div
              key: beatmapset.id
              className: 'osu-layout__col osu-layout__col--sm-6'
              el BeatmapsetPanel, beatmap: beatmapset

          div
            className: 'osu-layout__col',
            el ShowMoreLink,
              modifiers: ['profile-page', 't-greyseafoam-dark']
              event: 'profile:showMore'
              hasMore: @props.pagination[section].hasMore
              loading: @props.pagination[section].loading
              data:
                name: section
                url: laroute.route 'users.beatmapsets',
                  user: @props.user.id
                  type: sectionSnaked

      else
        p className: 'page-extra-entries', osu.trans('users.show.extra.beatmaps.none')
