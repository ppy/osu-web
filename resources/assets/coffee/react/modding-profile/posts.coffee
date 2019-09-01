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
import { div, h2, a, img, span } from 'react-dom-factories'
import { ValueDisplay } from 'value-display'
import { Post } from "../beatmap-discussions/post"

el = React.createElement

export class Posts extends React.Component
  render: =>
    div className: 'page-extra',
      h2 className: 'title title--page-extra', osu.trans('users.show.extra.posts.title_longer')
      div className: 'modding-profile-list',
        if @props.posts.length == 0
          div className: 'modding-profile-list__empty', osu.trans('users.show.extra.none')
        else
          [
            for post in @props.posts
              canModeratePosts = BeatmapDiscussionHelper.canModeratePosts(currentUser)
              canBeDeleted = canModeratePosts || currentUser.id? == post.user_id

              discussionClasses = 'beatmap-discussion beatmap-discussion--preview'

              if post.deleted_at?
                discussionClasses += ' beatmap-discussion--deleted'

              div
                key: post.id
                className: 'modding-profile-list__row',

                a
                  className: 'modding-profile-list__thumbnail'
                  href: BeatmapDiscussionHelper.url(discussion: post.beatmap_discussion),

                  img className: 'beatmapset-activities__beatmapset-cover', src: post.beatmap_discussion.beatmapset.covers.list

                div className: "modding-profile-list__timestamp hidden-xs",
                  div className: "beatmap-discussion-timestamp",
                    div className: "beatmap-discussion-timestamp__icons-container",
                      span className: "fas fa-reply"

                div className: discussionClasses,
                  div className: "beatmap-discussion__discussion",
                    el Post,
                      key: post.id
                      beatmapset: post.beatmap_discussion.beatmapset
                      discussion: post.beatmap_discussion
                      post: post
                      type: 'reply'
                      users: @props.users
                      user: @props.users[post.user_id]
                      read: true
                      lastEditor: @props.users[post.last_editor_id]
                      canBeEdited: currentUser.is_admin || currentUser.id? == post.user_id
                      canBeDeleted: canBeDeleted
                      canBeRestored: canModeratePosts
                      currentUser: currentUser
            a
              key: 'show-more'
              className: 'modding-profile-list__show-more'
              href: laroute.route('users.modding.posts', {user: @props.user.id}),
              osu.trans('users.show.extra.posts.show_more')
          ]
