# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import BbcodePreview from 'core-legacy/bbcode-preview'
import BeatmapPack from 'core-legacy/beatmap-pack'
import CheckboxValidation from 'core-legacy/checkbox-validation'
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
import Search from 'core-legacy/search'
import { StoreCheckout } from 'core-legacy/store-checkout'
import TooltipDefault from 'core-legacy/tooltip-default'
import { navigate } from 'utils/turbolinks'

moment.relativeTimeThreshold('ss', 44)
moment.relativeTimeThreshold('s', 120)
moment.relativeTimeThreshold('m', 120)
moment.relativeTimeThreshold('h', 48)
moment.relativeTimeThreshold('d', 62)
moment.relativeTimeThreshold('M', 24)
jQuery.timeago.inWords = (distanceMillis) ->
  moment.duration(-1 * distanceMillis).humanize(true)

$(document).on 'turbo:load', ->
  BeatmapPack.initialize()
  StoreCheckout.initialize()

window.bbcodePreview ?= new BbcodePreview
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
window.search ?= new Search
window.tooltipDefault ?= new TooltipDefault

window.formConfirmation ?= new FormConfirmation(window.formError)
window.forumPostsSeek ?= new ForumPostsSeek(window.forum)
window.forumTopicPostJump ?= new ForumTopicPostJump(window.forum)
window.forumTopicReply ?= new ForumTopicReply(bbcodePreview: window.bbcodePreview, forum: window.forum, stickyFooter: osuCore.stickyFooter)
window.nav2 ?= new Nav2(osuCore.clickMenu, osuCore.captcha)


$(document).on 'change', '.js-url-selector', (e) ->
  navigate e.target.value, (e.target.dataset.keepScroll == '1')


$(document).on 'keydown', (e) ->
  $.publish 'key:esc' if e.key == 'Escape'
