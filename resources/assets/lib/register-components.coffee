import { ReactTurbolinks } from 'react-turbolinks'
import { BeatmapsetPanel } from 'beatmapset-panel'
import { BlockButton } from 'block-button'
import { Comments } from 'comments'
import { CommentsManager } from 'comments-manager'
import { CountdownTimer } from 'countdown-timer'
import { FriendButton } from 'friend-button'
import { LandingNews } from 'landing-news'
import NotificationWidget from 'notification-widget/main'
import NotificationWidgetWorker from 'notification-widget/worker'
import QuickSearch from 'quick-search/main'
import QuickSearchWorker from 'quick-search/worker'
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

reactTurbolinks.register 'beatmapset-panel', BeatmapsetPanel, (el) ->
  JSON.parse(el.dataset.beatmapsetPanel)

reactTurbolinks.register 'spotlight-select-options', SpotlightSelectOptions, ->
  osu.parseJson 'json-spotlight-select-options'

reactTurbolinks.register 'comments', CommentsManager, (el) ->
  props = JSON.parse(el.dataset.props)
  props.component = Comments

  props

notificationWorker = new NotificationWidgetWorker()
resetNotificationWorker = -> notificationWorker.setUserId(currentUser.id)
$(document).ready resetNotificationWorker
$.subscribe 'user:update', resetNotificationWorker

reactTurbolinks.registerPersistent 'notification', NotificationWidget, true, (el) ->
  type: el.dataset.notificationType
  worker: notificationWorker

quickSearchWorker = new QuickSearchWorker()
reactTurbolinks.registerPersistent 'quick-search', QuickSearch, true, ->
  worker: quickSearchWorker

reactTurbolinks.register 'user-card', UserCard, (el) ->
  modifiers: try JSON.parse(el.dataset.modifiers)
  user: try JSON.parse(el.dataset.user)

reactTurbolinks.register 'user-card-store', UserCardStore, (el) ->
  container: el
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
