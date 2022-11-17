# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { BeatmapsContext } from 'beatmap-discussions/beatmaps-context'
import { BeatmapsetsContext } from 'beatmap-discussions/beatmapsets-context'
import BeatmapsetCover from 'components/beatmapset-cover'
import { route } from 'laroute'
import * as React from 'react'
import { div, h2, a, img } from 'react-dom-factories'
import { trans } from 'utils/lang'
import { Discussion } from "../beatmap-discussions/discussion"

el = React.createElement

export class Discussions extends React.Component
  render: =>
    div className: 'page-extra',
      h2 className: 'title title--page-extra', trans("users.show.extra.discussions.title_longer")
      div className: 'modding-profile-list',
        if @props.discussions.length == 0
          div className: 'modding-profile-list__empty', trans('users.show.extra.none')
        else
          el BeatmapsetsContext.Consumer, null, (beatmapsets) =>
            el BeatmapsContext.Consumer, null, (beatmaps) =>
              el React.Fragment, null,
                for discussion in @props.discussions
                  div
                    className: 'modding-profile-list__row'
                    key: discussion.id,

                    a
                      className: 'modding-profile-list__thumbnail'
                      href: BeatmapDiscussionHelper.url(discussion: discussion),

                      el BeatmapsetCover, beatmapset: beatmapsets[discussion.beatmapset_id], size: 'list'

                    el Discussion,
                      discussion: discussion
                      users: @props.users
                      currentBeatmap: beatmaps[discussion.beatmap_id]
                      currentUser: currentUser
                      beatmapset: beatmapsets[discussion.beatmapset_id]
                      isTimelineVisible: false
                      visible: false
                      showDeleted: true
                      preview: true
                a
                  className: 'modding-profile-list__show-more'
                  href: route('beatmapsets.discussions.index', {user: @props.user.id}),
                  trans('users.show.extra.discussions.show_more')
