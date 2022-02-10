# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute'
import * as React from 'react'
import { div, h2, a, img, span } from 'react-dom-factories'
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

              discussionClasses = 'beatmap-discussion beatmap-discussion--preview beatmap-discussion--modding-profile'

              if post.deleted_at?
                discussionClasses += ' beatmap-discussion--deleted'

              div
                key: post.id
                className: 'modding-profile-list__row',

                a
                  className: 'modding-profile-list__thumbnail'
                  href: BeatmapDiscussionHelper.url(discussion: post.beatmap_discussion),

                  img className: 'beatmapset-cover', src: post.beatmap_discussion.beatmapset.covers.list

                div className: "modding-profile-list__timestamp hidden-xs",
                  div className: "beatmap-discussion-timestamp",
                    div className: "beatmap-discussion-timestamp__icons-container",
                      span
                        className: 'fas fa-reply'
                        title: osu.trans 'common.buttons.reply'

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
                      lastEditor: @props.users[post.last_editor_id] ? @props.users[null] if post.last_editor_id?
                      # FIXME: These permissions are more restrictive than the correct ones in discussion
                      # because they don't have the right data to check.
                      canBeEdited: currentUser.is_admin
                      canBeDeleted: canModeratePosts
                      canBeRestored: canModeratePosts
                      currentUser: currentUser
            a
              key: 'show-more'
              className: 'modding-profile-list__show-more'
              href: route('users.modding.posts', {user: @props.user.id}),
              osu.trans('users.show.extra.posts.show_more')
          ]
