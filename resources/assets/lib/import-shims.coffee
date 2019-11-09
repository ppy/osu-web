###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

# Import shim so that globally declared scripts can work without changes.

import Enchant from 'enchant'
import ForumPoll from 'forum-poll'
import * as laroute from 'laroute'
import { StoreCheckout } from 'store-checkout'
import Promise from 'promise-polyfill'
import TextareaAutosize from 'react-autosize-textarea'
import GalleryContest from 'gallery-contest'
import WindowVHPatcher from 'window-vh-patcher'
import TurbolinksReload from 'turbolinks-reload'

# polyfill non-Edge IE
window.Promise ?= Promise

window._exported = {
  Enchant
  ForumPoll
  GalleryContest
  TurbolinksReload
  WindowVHPatcher
}

# FIXME: remove once everything imports instead of using global
window.laroute ?= laroute

# refer to variables.less
window._styles =
  header:
    height: 90 # @nav2-height
    heightSticky: 50 # @nav2-height--pinned
    heightMobile: 60 # @navbar-height

window.StoreCheckout = StoreCheckout
window.TextareaAutosize = TextareaAutosize
