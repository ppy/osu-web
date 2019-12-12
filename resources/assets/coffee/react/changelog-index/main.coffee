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

import { Build } from 'build'
import { ChangelogHeaderStreams } from 'changelog-header-streams'
import HeaderV4 from 'header-v4'
import * as React from 'react'
import { button, div, h1, p, span } from 'react-dom-factories'
import { ShowMoreLink } from 'show-more-link'
el = React.createElement

groupChangelogBuilds = (builds) ->
  _.groupBy builds, (build) ->
    # Assumes created_at an iso8601 datetime string and removes the time portion.
    # Example: 2018-07-06T05:43:21+00:00
    build.created_at.substr(0, 10)


export class Main extends React.PureComponent
  constructor: (props) ->
    super props

    @state = @newStateFromData(props.data)
    @state.loading = false


  componentDidMount: =>
    changelogChartLoader.initialize()


  render: =>
    el React.Fragment, null,
      el HeaderV4,
        theme: 'changelog'
        links: @headerLinks()
        linksBreadcrumb: true
        section: osu.trans 'layout.header.changelog._'
        subSection: osu.trans 'layout.header.changelog.index'

      div className: 'osu-page osu-page--changelog',
        el ChangelogHeaderStreams, updateStreams: @props.updateStreams

        div className: 'js-changelog-chart'

        div className: 'builds',
          for own date, builds of groupChangelogBuilds(@state.builds)
            div
              key: date
              className: 'builds__group',
              div className: 'builds__date', moment(date).format('LL')

              for build in builds
                div
                  key: build.id
                  className: 'builds__item'
                  el Build, build: build

        el ShowMoreLink,
          callback: @showMore
          hasMore: @state.hasMore
          loading: @state.loading
          modifiers: ['t-greyviolet-darker', 'changelog-index']


  headerLinks: =>
    [
      {
        title: osu.trans 'layout.header.changelog.index'
        url: laroute.route('changelog.index')
      }
    ]


  showMore: =>
    return if !@state.hasMore

    search = osu.jsonClone @props.data.search
    search.max_id = _.last(@state.builds).id - 1
    @setState loading: true

    $.get laroute.route('changelog.index'), search
    .done (data) =>
      @setState @newStateFromData(data)
    .always =>
      @setState loading: false


  newStateFromData: (data) =>
    hasMore = data.builds.length == data.search.limit
    builds = (@state?.builds ? []).concat data.builds
    # remove one so there's at least one more to be loaded
    builds.pop() if hasMore

    {hasMore, builds}
