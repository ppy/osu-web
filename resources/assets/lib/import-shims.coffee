# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

# Import shim so that globally declared scripts can work without changes.

import Blackout from 'blackout'
import Gallery from 'gallery'
import * as laroute from 'laroute'
import Promise from 'promise-polyfill'
import { StoreCheckout } from 'store-checkout'
import { fileuploadFailCallback } from 'utils/ajax'
import { classWithModifiers } from 'utils/css'
import { discussionLinkify } from 'utils/beatmapset-discussion-helper'
import { fadeIn, fadeOut, fadeToggle } from 'utils/fade'
import { make2x } from 'utils/html'
import { jsonClone, parseJson, parseJsonNullable, storeJson } from 'utils/json'
import { pageChange, pageChangeImmediate } from 'utils/page-change'
import { currentUrl } from 'utils/turbolinks'
import * as OsuUrlHelper from 'utils/url'

# polyfill non-Edge IE
window.Promise ?= Promise

window.Blackout = Blackout

window.Fade =
  in: fadeIn
  out: fadeOut
  toggle: fadeToggle

window.gallery ?= new Gallery

window._exported = {
  OsuUrlHelper
  classWithModifiers
  currentUrl
  discussionLinkify
  fileuploadFailCallback
  make2x
  pageChange
  pageChangeImmediate
}

# FIXME: remove once everything imports instead of using global
window.laroute ?= laroute

# refer to variables.less
window._styles =
  header:
    height: 90 # @nav2-height
    heightSticky: 50 # @nav2-height--pinned
    heightMobile: 50 # @navbar-height

window.StoreCheckout = StoreCheckout

window.osu.parseJson = parseJson
window.osu.parseJsonNullable = parseJsonNullable
