###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
#
#    This file is part of osu!web. osu!web is distributed with the hope of
#    attracting more community contributions to the core ecosystem of osu!.
#
#    osu!web is free software: you can redistribute it and/or modify
#    it under the terms of the Affero GNU General Public License version 3
#    as published by the Free Software Foundation.
#
#    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
#    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
#    See the GNU Affero General Public License for more details.
#
#    You should have received a copy of the GNU Affero General Public License
#    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###

# Import shim so that globally declared scripts can work without changes.

import ClickMenu from 'click-menu'
import Fade from 'fade'
import Enchant from 'enchant'
import ForumPoll from 'forum-poll'
import * as laroute from 'laroute'
import { StoreCheckout } from 'store-checkout'
import Promise from 'promise-polyfill'
import TextareaAutosize from 'react-autosize-textarea'
import GalleryContest from 'gallery-contest'
import WindowVHPatcher from 'window-vh-patcher'
import TurbolinksReload from 'turbolinks-reload'
import OsuUrlHelper from 'osu-url-helper'

# polyfill non-Edge IE
window.Promise ?= Promise

window.Fade = Fade

window._exported = {
  ClickMenu
  Enchant
  ForumPoll
  GalleryContest
  OsuUrlHelper
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
