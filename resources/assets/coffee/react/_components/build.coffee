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

import { ChangelogEntry } from 'changelog-entry'
import * as React from 'react'
import { a, div, i, span } from 'react-dom-factories'
el = React.createElement

export class Build extends React.PureComponent
  render: =>
    blockClass = osu.classWithModifiers 'build', @props.modifiers
    entries = _.groupBy(@props.build.changelog_entries, 'category')
    categories = _(entries).keys().sort().value()

    div className: "#{blockClass} t-changelog-stream--#{_.kebabCase @props.build.update_stream.display_name}",
      div className: 'build__version',
        @renderNav version: 'previous', icon: 'fas fa-chevron-left'

        a
          className: 'build__version-link'
          href: _exported.OsuUrlHelper.changelogBuild @props.build
          span className: 'build__stream', @props.build.update_stream.display_name
          ' '
          span className: 'u-changelog-stream--text', @props.build.display_version

        @renderNav version: 'next', icon: 'fas fa-chevron-right'

      if @props.showDate ? false
        div className: 'build__date', moment(@props.build.created_at).format('LL')

      for category in categories
        div
          key: category
          className: 'build__changelog-entries-container'
          div className: 'build__changelog-entries-category', category
          div className: 'build__changelog-entries',
            for entry in entries[category]
              div
                key: entry.id ? "#{entry.created_at}-#{entry.title}"
                className: 'build__changelog-entry'
                el ChangelogEntry, entry: entry


  renderNav: ({version, icon}) =>
    return unless @props.build.versions?

    build = @props.build.versions[version]

    if build?
      a
        className: 'build__version-link'
        href: _exported.OsuUrlHelper.changelogBuild build
        title: build.display_version
        i className: icon
    else
      span
        className: 'build__version-link build__version-link--disabled'
        i className: icon
