# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import Forum from 'core-legacy/forum'
import Gallery from 'gallery'
import { StoreCheckout } from 'store-checkout'
import { hideLoadingOverlay, showLoadingOverlay } from 'utils/loading-overlay'

window.polyfills ?= new Polyfills

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
window.formPlaceholderHide ?= new FormPlaceholderHide
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
