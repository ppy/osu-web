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

import * as React from 'react'
import { a, div, p } from 'react-dom-factories'
el = React.createElement

export class ChangelogHeaderStreams extends React.PureComponent
  render: =>
    div className: osu.classWithModifiers('update-streams-v2', ['with-active' if @props.currentStreamId?]),
      div className: 'update-streams-v2__container',
        for stream in @props.updateStreams
          @renderHeaderStream stream: stream


  renderHeaderStream: ({stream}) =>
    streamNameClass = _.kebabCase(stream.display_name)
    mainClass = osu.classWithModifiers 'update-streams-v2__item', [
      streamNameClass
      'featured' if stream.is_featured
      'active' if @props.currentStreamId == stream.id
    ]
    mainClass += " t-changelog-stream--#{streamNameClass}"

    a
      href: _exported.OsuUrlHelper.changelogBuild stream.latest_build
      key: stream.id
      className: mainClass
      div className: 'update-streams-v2__bar u-changelog-stream--bg'
      p className: 'update-streams-v2__row update-streams-v2__row--name', stream.display_name
      p className: 'update-streams-v2__row update-streams-v2__row--version', stream.latest_build.display_version
      if stream.user_count > 0
        p
          className: 'update-streams-v2__row update-streams-v2__row--users'
          osu.transChoice 'changelog.builds.users_online', stream.user_count
