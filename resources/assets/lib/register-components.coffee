# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import ReactTurbolinks from 'react-turbolinks'
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
import core from 'osu-core-singleton'
import { createElement } from 'react'

# Globally init countdown timers
core.reactTurbolinks.register 'countdownTimer', false, (e) ->
  createElement CountdownTimer, deadline: e.dataset.deadline

# Globally init friend buttons
core.reactTurbolinks.register 'friendButton', false, (target) ->
  createElement FriendButton,
    container: target
    userId: parseInt(target.dataset.target)

# Globally init block buttons
core.reactTurbolinks.register 'blockButton', false, (target) ->
  createElement BlockButton,
    container: target
    userId: parseInt(target.dataset.target)

core.reactTurbolinks.register 'beatmap-discussion-events', false, (container) ->
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

  createElement Events, props


core.reactTurbolinks.register 'beatmapset-panel', false, (el) ->
  createElement BeatmapsetPanel, observable(JSON.parse(el.dataset.beatmapsetPanel))

core.reactTurbolinks.register 'forum-post-report', true, -> createElement(ForumPostReport)

core.reactTurbolinks.register 'spotlight-select-options', false, ->
  createElement SpotlightSelectOptions, osu.parseJson('json-spotlight-select-options')

core.reactTurbolinks.register 'multiplayer-select-options', true, ->
  createElement MultiplayerSelectOptions, osu.parseJson('json-multiplayer-select-options')

core.reactTurbolinks.register 'comments', false, (el) ->
  props = JSON.parse(el.dataset.props)
  props.component = Comments

  createElement CommentsManager, props

core.reactTurbolinks.register 'chat-icon', true, (el) ->
  createElement ChatIcon, type: el.dataset.type

core.reactTurbolinks.register 'main-notification-icon', true, (el) ->
  createElement MainNotificationIcon, type: el.dataset.type

core.reactTurbolinks.register 'notification-widget', true, (el) ->
  createElement NotificationWidget, (try JSON.parse(el.dataset.notificationWidget))

quickSearchWorker = new QuickSearchWorker()
core.reactTurbolinks.register 'quick-search', true, ->
  createElement QuickSearch, worker: quickSearchWorker

core.reactTurbolinks.register 'quick-search-button', true, ->
  createElement QuickSearchButton, worker: quickSearchWorker

core.reactTurbolinks.register 'ranking-filter', true, (el) ->
  createElement RankingFilter,
    countries: osu.parseJson 'json-countries'
    gameMode: el.dataset.gameMode
    type: el.dataset.type
    variants: try JSON.parse(el.dataset.variants)

core.reactTurbolinks.register 'user-card', false, (el) ->
  createElement UserCard,
    modifiers: try JSON.parse(el.dataset.modifiers)
    user: if el.dataset.isCurrentUser then currentUser else try JSON.parse(el.dataset.user)

core.reactTurbolinks.register 'user-card-store', false, (el) ->
  createElement UserCardStore, user: JSON.parse(el.dataset.user)

core.reactTurbolinks.register 'user-card-tooltip', false, (el) ->
  createElement UserCardTooltip,
    container: el
    lookup: el.dataset.lookup

$(document).ready startListening
core.reactTurbolinks.register 'user-cards', false, (el) ->
  createElement UserCards,
    modifiers: try JSON.parse(el.dataset.modifiers)
    users: try JSON.parse(el.dataset.users)

core.reactTurbolinks.register 'wiki-search', false, -> createElement(WikiSearch)

core.reactTurbolinks.register 'landing-news', false, ->
  createElement LandingNews, posts: osu.parseJson 'json-posts'
