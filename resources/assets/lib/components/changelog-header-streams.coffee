# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { a, div, p } from 'react-dom-factories'
import { classWithModifiers } from 'utils/css'
import { changelogBuild } from 'utils/url'

el = React.createElement

export class ChangelogHeaderStreams extends React.PureComponent
  render: =>
    div className: classWithModifiers('update-streams-v2', ['with-active' if @props.currentStreamId?]),
      div className: 'update-streams-v2__container',
        for stream in @props.updateStreams
          @renderHeaderStream stream: stream


  renderHeaderStream: ({stream}) =>
    streamNameClass = _.kebabCase(stream.display_name)
    mainClass = classWithModifiers 'update-streams-v2__item', [
      streamNameClass
      'featured' if stream.is_featured
      'active' if @props.currentStreamId == stream.id
    ]
    mainClass += " t-changelog-stream--#{streamNameClass}"

    a
      href: changelogBuild stream.latest_build
      key: stream.id
      className: mainClass
      div className: 'update-streams-v2__bar u-changelog-stream--bg'
      p className: 'update-streams-v2__row update-streams-v2__row--name', stream.display_name
      p className: 'update-streams-v2__row update-streams-v2__row--version', stream.latest_build.display_version
      if stream.user_count > 0
        p
          className: 'update-streams-v2__row update-streams-v2__row--users'
          osu.transChoice 'changelog.builds.users_online', stream.user_count
