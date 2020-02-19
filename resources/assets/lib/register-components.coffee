import { ReactTurbolinks } from 'react-turbolinks'
import { BeatmapsetPanel } from 'beatmapset-panel'
import { BlockButton } from 'block-button'
import { Comments } from 'comments'
import { CommentsManager } from 'comments-manager'
import { CountdownTimer } from 'countdown-timer'
import { FriendButton } from 'friend-button'
import { LandingNews } from 'landing-news'
import NotificationIcon from 'notification-icon'
import NotificationWidget from 'notification-widget/main'
import NotificationWorker from 'notifications/worker'
import QuickSearch from 'quick-search/main'
import QuickSearchButton from 'quick-search-button'
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

notificationWorker = new NotificationWorker()
resetNotificationWorker = -> notificationWorker.setUserId(currentUser.id)
$(document).ready resetNotificationWorker
$.subscribe 'user:update', resetNotificationWorker

reactTurbolinks.registerPersistent 'notification-icon', NotificationIcon, true, (el) ->
  props = (try JSON.parse(el.dataset.notificationIcon)) ? {}
  props.worker = notificationWorker

  props

reactTurbolinks.registerPersistent 'notification-widget', NotificationWidget, true, (el) ->
  try JSON.parse(el.dataset.notificationWidget)

quickSearchWorker = new QuickSearchWorker()
reactTurbolinks.registerPersistent 'quick-search', QuickSearch, true, (el) ->
  worker: quickSearchWorker

reactTurbolinks.registerPersistent 'quick-search-button', QuickSearchButton, true, ->
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
