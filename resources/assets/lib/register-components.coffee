# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import Events from 'beatmap-discussions/events'
import BeatmapsetPanel from 'components/beatmapset-panel'
import BlockButton from 'components/block-button'
import ChatIcon from 'components/chat-icon'
import { Comments } from 'components/comments'
import { CommentsManager } from 'components/comments-manager'
import { CountdownTimer } from 'components/countdown-timer'
import ForumPostReport from 'components/forum-post-report'
import { LandingNews } from 'components/landing-news'
import MainNotificationIcon from 'components/main-notification-icon'
import MultiplayerSelectOptions from 'components/multiplayer-select-options'
import QuickSearchButton from 'components/quick-search-button'
import RankingFilter from 'components/ranking-filter'
import { SpotlightSelectOptions } from 'components/spotlight-select-options'
import { UserCard } from 'components/user-card'
import { UserCardStore } from 'components/user-card-store'
import { startListening, UserCardTooltip } from 'components/user-card-tooltip'
import { UserCards } from 'components/user-cards'
import { WikiSearch } from 'components/wiki-search'
import { keyBy } from 'lodash'
import { observable } from 'mobx'
import { deletedUser } from 'models/user'
import NotificationWidget from 'notification-widget/main'
import NotificationWorker from 'notifications/worker'
import QuickSearch from 'quick-search/main'
import QuickSearchWorker from 'quick-search/worker'
import SocketWorker from 'socket-worker'
import core from 'osu-core-singleton'
import { createElement } from 'react'
import { parseJson, parseJsonNullable } from 'utils/json'

# Globally init countdown timers
core.reactTurbolinks.register 'countdownTimer', (container) ->
  createElement CountdownTimer, deadline: container.dataset.deadline

# Globally init block buttons
core.reactTurbolinks.register 'blockButton', (container) ->
  createElement BlockButton,
    userId: parseInt(container.dataset.target)

core.reactTurbolinks.register 'beatmap-discussion-events', (container) ->
  props = {
    events: parseJson('json-events')
    mode: 'list'
  }

  # TODO: move to store?
  users = parseJson('json-users')
  props.users = _.keyBy(users, 'id')
  props.users[null] = props.users[undefined] = deletedUser.toJson()

  createElement Events, props


core.reactTurbolinks.register 'beatmapset-panel', (container) ->
  createElement BeatmapsetPanel, observable(JSON.parse(container.dataset.beatmapsetPanel))

core.reactTurbolinks.register 'forum-post-report', -> createElement(ForumPostReport)

core.reactTurbolinks.register 'spotlight-select-options', ->
  createElement SpotlightSelectOptions, parseJson('json-spotlight-select-options')

core.reactTurbolinks.register 'multiplayer-select-options', ->
  createElement MultiplayerSelectOptions, parseJson('json-multiplayer-select-options')

core.reactTurbolinks.register 'comments', (container) ->
  props = JSON.parse(container.dataset.props)
  props.component = Comments

  createElement CommentsManager, props

core.reactTurbolinks.register 'chat-icon', (container) ->
  createElement ChatIcon, type: container.dataset.type

core.reactTurbolinks.register 'main-notification-icon', (container) ->
  createElement MainNotificationIcon, type: container.dataset.type

core.reactTurbolinks.register 'notification-widget', (container) ->
  createElement NotificationWidget, (try JSON.parse(container.dataset.notificationWidget))

quickSearchWorker = new QuickSearchWorker()
core.reactTurbolinks.register 'quick-search', ->
  createElement QuickSearch, worker: quickSearchWorker

core.reactTurbolinks.register 'quick-search-button', ->
  createElement QuickSearchButton, worker: quickSearchWorker

core.reactTurbolinks.register 'ranking-filter', (container) ->
  createElement RankingFilter,
    countries: parseJsonNullable 'json-countries'
    gameMode: container.dataset.gameMode
    type: container.dataset.type
    variants: try JSON.parse(container.dataset.variants)

core.reactTurbolinks.register 'user-card', (container) ->
  createElement UserCard,
    modifiers: try JSON.parse(container.dataset.modifiers)
    user: if container.dataset.isCurrentUser then currentUser else try JSON.parse(container.dataset.user)

core.reactTurbolinks.register 'user-card-store', (container) ->
  createElement UserCardStore, user: JSON.parse(container.dataset.user)

core.reactTurbolinks.register 'user-card-tooltip', (container) ->
  createElement UserCardTooltip,
    container: container
    lookup: container.dataset.lookup

$(document).ready startListening
core.reactTurbolinks.register 'user-cards', (container) ->
  createElement UserCards,
    modifiers: try JSON.parse(container.dataset.modifiers)
    users: try JSON.parse(container.dataset.users)

core.reactTurbolinks.register 'wiki-search', -> createElement(WikiSearch)

core.reactTurbolinks.register 'landing-news', ->
  createElement LandingNews, posts: parseJson('json-posts')
