# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { ExtraHeader } from './extra-header'
import BeatmapsetPanel from 'beatmapset-panel'
import { observable } from 'mobx'
import * as React from 'react'
import { div, h2, h3, ul, li, a, p, pre, span } from 'react-dom-factories'
import ShowMoreLink from 'show-more-link'
el = React.createElement

sections = [
  'favouriteBeatmapsets'
  'rankedBeatmapsets'
  'lovedBeatmapsets'
  'pendingBeatmapsets'
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

    el React.Fragment, key: section,
      h3
        className: 'title title--page-extra-small'
        osu.trans("users.show.extra.beatmaps.#{sectionSnaked}.title")
        span className: 'title__count', osu.formatNumber(count)

      if beatmapsets.length > 0
        div className: 'osu-layout__col-container osu-layout__col-container--with-gutter js-audio--group',
          for beatmapset in beatmapsets
            div
              key: beatmapset.id
              className: 'osu-layout__col osu-layout__col--sm-6'
              el BeatmapsetPanel, beatmapset: observable(beatmapset)

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
