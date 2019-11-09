###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

import * as React from 'react'
import { button, div, span } from 'react-dom-factories'
el = React.createElement

bn = 'beatmap-discussion-system-post'

export SystemPost = (props) ->
  message =
    switch props.post.message.type
      when 'resolved'
        osu.trans "beatmap_discussions.system.resolved.#{props.post.message.value}",
          user: osu.link laroute.route('users.show', user: props.user.id), props.user.username,
            classNames: ["#{bn}__user"]

  topClass = "#{bn} #{bn}--#{props.post.message.type}"
  topClass += " #{bn}--deleted" if props.post.deleted_at

  div
    className: topClass
    div
      className: "#{bn}__content"
      dangerouslySetInnerHTML:
        __html: message
