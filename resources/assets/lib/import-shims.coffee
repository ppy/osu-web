# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

# Import shim so that globally declared scripts can work without changes.

import Blackout from 'blackout'
import Fade from 'fade'
import Gallery from 'gallery'
import * as laroute from 'laroute'
import { StoreCheckout } from 'store-checkout'
import Promise from 'promise-polyfill'
import OsuCommon from 'osu-common'
import OsuUrlHelper from 'osu-url-helper'
import Timeout from 'timeout'
import { fileuploadFailCallback } from 'utils/ajax'
import { discussionLinkify } from 'utils/beatmapset-discussion-helper'
import { make2x } from 'utils/html'
import { pageChange, pageChangeImmediate } from 'utils/page-change'
import { currentUrl } from 'utils/turbolinks'

# polyfill non-Edge IE
window.Promise ?= Promise

window.Blackout = Blackout

window.Fade = Fade

window.gallery ?= new Gallery

window._exported = {
  OsuUrlHelper
  currentUrl
  discussionLinkify
  fileuploadFailCallback
  make2x
  pageChange
  pageChangeImmediate
}

# FIXME: remove once everything imports instead of using global
window.laroute ?= laroute

window.osu = OsuCommon

# refer to variables.less
window._styles =
  header:
    height: 90 # @nav2-height
    heightSticky: 50 # @nav2-height--pinned
    heightMobile: 50 # @navbar-height

window.StoreCheckout = StoreCheckout

window.Timeout = Timeout
