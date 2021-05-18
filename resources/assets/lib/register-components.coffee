# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { ReactTurbolinks } from 'react-turbolinks'
import Events from 'beatmap-discussions/events'
import BeatmapsetPanel from 'beatmapset-panel'
import { BlockButton } from 'block-button'
import ChatIcon from 'chat-icon'
import { Comments } from 'comments'
import { CommentsManager } from 'comments-manager'
import { CountdownTimer } from 'countdown-timer'
import ForumPostReport from 'forum-post-report'
import { FriendButton } from 'friend-button'
import { LandingNews } from 'landing-news'
import { keyBy } from 'lodash'
import { observable } from 'mobx'
import { deletedUser } from 'models/user'
import MainNotificationIcon from 'main-notification-icon'
import MultiplayerSelectOptions from 'multiplayer-select-options'
import NotificationWidget from 'notification-widget/main'
import NotificationWorker from 'notifications/worker'
import QuickSearch from 'quick-search/main'
import QuickSearchButton from 'quick-search-button'
import QuickSearchWorker from 'quick-search/worker'
import RankingFilter from 'ranking-filter'
import SocketWorker from 'socket-worker'
import { SpotlightSelectOptions } from 'spotlight-select-options'
import { UserCard } from 'user-card'
import { UserCardStore } from 'user-card-store'
import { startListening, UserCardTooltip } from 'user-card-tooltip'
import { UserCards } from 'user-cards'
import { WikiSearch } from 'wiki-search'

window.reactTurbolinks ?= new ReactTurbolinks()

# Globally init countdown timers
reactTurbolinks.register 'countdownTimer', CountdownTimer, (e) ->
  deadline: e.dataset.deadline

# Globally init friend buttons
reactTurbolinks.register 'friendButton', FriendButton, (target) ->
  container: target
  userId: parseInt(target.dataset.target)

# Globally init block buttons
reactTurbolinks.register 'blockButton', BlockButton, (target) ->
  container: target
  userId: parseInt(target.dataset.target)


reactTurbolinks.register 'beatmap-discussion-events', Events, (container) ->
  props = {
    container
    discussions: osu.parseJson('json-discussions')
    events: osu.parseJson('json-events')
    posts: osu.parseJson('json-posts')
  }

  # TODO: move to store?
  users = osu.parseJson('json-users')
  props.users = _.keyBy(users, 'id')
  props.users[null] = props.users[undefined] = deletedUser.toJson()

  props


reactTurbolinks.register 'beatmapset-panel', BeatmapsetPanel, (el) ->
  observable(JSON.parse(el.dataset.beatmapsetPanel))

reactTurbolinks.registerPersistent 'forum-post-report', ForumPostReport

reactTurbolinks.register 'spotlight-select-options', SpotlightSelectOptions, ->
  osu.parseJson 'json-spotlight-select-options'

reactTurbolinks.registerPersistent 'multiplayer-select-options', MultiplayerSelectOptions, true, ->
  osu.parseJson 'json-multiplayer-select-options'

reactTurbolinks.register 'comments', CommentsManager, (el) ->
  props = JSON.parse(el.dataset.props)
  props.component = Comments

  props

reactTurbolinks.registerPersistent 'chat-icon', ChatIcon, true, (el) ->
  type: el.dataset.type

reactTurbolinks.registerPersistent 'main-notification-icon', MainNotificationIcon, true, (el) ->
  type: el.dataset.type

reactTurbolinks.registerPersistent 'notification-widget', NotificationWidget, true, (el) ->
  try JSON.parse(el.dataset.notificationWidget)

quickSearchWorker = new QuickSearchWorker()
reactTurbolinks.registerPersistent 'quick-search', QuickSearch, true, (el) ->
  worker: quickSearchWorker

reactTurbolinks.registerPersistent 'quick-search-button', QuickSearchButton, true, ->
  worker: quickSearchWorker

reactTurbolinks.registerPersistent 'ranking-filter', RankingFilter, true, (el) ->
  countries: osu.parseJson 'json-countries'
  gameMode: el.dataset.gameMode
  type: el.dataset.type
  variants: try JSON.parse(el.dataset.variants)

reactTurbolinks.register 'user-card', UserCard, (el) ->
  modifiers: try JSON.parse(el.dataset.modifiers)
  user: if el.dataset.isCurrentUser then currentUser else try JSON.parse(el.dataset.user)

reactTurbolinks.register 'user-card-store', UserCardStore, (el) ->
  user: JSON.parse(el.dataset.user)

reactTurbolinks.register 'user-card-tooltip', UserCardTooltip, (el) ->
  container: el
  lookup: el.dataset.lookup
$(document).ready startListening

reactTurbolinks.register 'user-cards', UserCards, (el) ->
  modifiers: try JSON.parse(el.dataset.modifiers)
  users: try JSON.parse(el.dataset.users)

reactTurbolinks.register 'wiki-search', WikiSearch

reactTurbolinks.register 'landing-news', LandingNews, (el) ->
  posts: osu.parseJson 'json-posts'
