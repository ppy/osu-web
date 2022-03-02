# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import AccountEditAvatar from 'core-legacy/account-edit-avatar'
import AccountEditBlocklist from 'core-legacy/account-edit-blocklist'
import AccountEdit from 'core-legacy/account-edit'
import BbcodePreview from 'core-legacy/bbcode-preview'
import BeatmapPack from 'core-legacy/beatmap-pack'
import ChangelogChartLoader from 'core-legacy/changelog-chart-loader'
import CheckboxValidation from 'core-legacy/checkbox-validation'
import CurrentUserObserver from 'core-legacy/current-user-observer'
import FancyGraph from 'core-legacy/fancy-graph'
import FormClear from 'core-legacy/form-clear'
import FormConfirmation from 'core-legacy/form-confirmation'
import FormError from 'core-legacy/form-error'
import FormToggle from 'core-legacy/form-toggle'
import Forum from 'core-legacy/forum'
import ForumAutoClick from 'core-legacy/forum-auto-click'
import ForumCover from 'core-legacy/forum-cover'
import ForumPostsSeek from 'core-legacy/forum-posts-seek'
import ForumTopicPostJump from 'core-legacy/forum-topic-post-jump'
import ForumTopicReply from 'core-legacy/forum-topic-reply'
import ForumTopicTitle from 'core-legacy/forum-topic-title'
import ForumTopicWatchAjax from 'core-legacy/forum-topic-watch-ajax'
import Gallery from 'core-legacy/gallery'
import GlobalDrag from 'core-legacy/global-drag'
import LandingGraph from 'core-legacy/landing-graph'
import Menu from 'core-legacy/menu'
import NavButton from 'core-legacy/nav-button'
import Nav2 from 'core-legacy/nav2'
import PostPreview from 'core-legacy/post-preview'
import Search from 'core-legacy/search'
import StickyFooter from 'core-legacy/sticky-footer'
import { StoreCheckout } from 'core-legacy/store-checkout'
import StoreSupporterTag from 'core-legacy/store-supporter-tag'
import SyncHeight from 'core-legacy/sync-height'
import TooltipBeatmap from 'core-legacy/tooltip-beatmap'
import TooltipDefault from 'core-legacy/tooltip-default'
import TwitchPlayer from 'core-legacy/twitch-player'
import { hideLoadingOverlay, showLoadingOverlay } from 'utils/loading-overlay'

Turbolinks.start()
Turbolinks.setProgressBarDelay(0)

moment.relativeTimeThreshold('ss', 44)
moment.relativeTimeThreshold('s', 120)
moment.relativeTimeThreshold('m', 120)
moment.relativeTimeThreshold('h', 48)
moment.relativeTimeThreshold('d', 62)
moment.relativeTimeThreshold('M', 24)
jQuery.timeago.inWords = (distanceMillis) ->
  moment.duration(-1 * distanceMillis).humanize(true)

# loading animation overlay
# fired from turbolinks
$(document).on 'turbolinks:request-start', showLoadingOverlay
$(document).on 'turbolinks:request-end', hideLoadingOverlay
# form submission is not covered by turbolinks
$(document).on 'submit', 'form', (e) ->
  showLoadingOverlay() if e.currentTarget.dataset.loadingOverlay != '0'

$(document).on 'turbolinks:load', ->
  BeatmapPack.initialize()
  StoreSupporterTag.initialize()
  StoreCheckout.initialize()

# ensure currentUser is updated early enough.
window.currentUserObserver ?= new CurrentUserObserver
window.syncHeight ?= new SyncHeight

window.accountEdit ?= new AccountEdit
window.accountEditAvatar ?= new AccountEditAvatar
window.accountEditBlocklist ?= new AccountEditBlocklist
window.bbcodePreview ?= new BbcodePreview
window.changelogChartLoader ?= new ChangelogChartLoader
window.checkboxValidation ?= new CheckboxValidation
window.fancyGraph ?= new FancyGraph
window.formClear ?= new FormClear
window.formError ?= new FormError
window.formToggle ?= new FormToggle
window.forum ?= new Forum
window.forumAutoClick ?= new ForumAutoClick
window.forumCover ?= new ForumCover
window.forumTopicTitle ?= new ForumTopicTitle
window.forumTopicWatchAjax ?= new ForumTopicWatchAjax
window.gallery ?= new Gallery
window.globalDrag ?= new GlobalDrag
window.landingGraph ?= new LandingGraph
window.menu ?= new Menu
window.navButton ?= new NavButton
window.postPreview ?= new PostPreview
window.search ?= new Search
window.stickyFooter ?= new StickyFooter
window.tooltipBeatmap ?= new TooltipBeatmap
window.tooltipDefault ?= new TooltipDefault

window.formConfirmation ?= new FormConfirmation(window.formError)
window.forumPostsSeek ?= new ForumPostsSeek(window.forum)
window.forumTopicPostJump ?= new ForumTopicPostJump(window.forum)
window.forumTopicReply ?= new ForumTopicReply(bbcodePreview: window.bbcodePreview, forum: window.forum, stickyFooter: window.stickyFooter)
window.nav2 ?= new Nav2(osuCore.clickMenu)
window.twitchPlayer ?= new TwitchPlayer(osuCore.turbolinksReload)


$(document).on 'change', '.js-url-selector', (e) ->
  osu.navigate e.target.value, (e.target.dataset.keepScroll == '1')


$(document).on 'keydown', (e) ->
  $.publish 'key:esc' if e.keyCode == 27
