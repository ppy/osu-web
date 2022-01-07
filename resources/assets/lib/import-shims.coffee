# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

# Import shim so that globally declared scripts can work without changes.

import Blackout from 'blackout'
import Gallery from 'gallery'
import * as laroute from 'laroute'
import { StoreCheckout } from 'store-checkout'
import { discussionLinkify } from 'utils/beatmapset-discussion-helper'
import { parseJson, parseJsonNullable } from 'utils/json'
import { pageChange, pageChangeImmediate } from 'utils/page-change'

window.Blackout = Blackout

window.gallery ?= new Gallery

window._exported = {
  discussionLinkify
  pageChange
  pageChangeImmediate
  parseJson
  parseJsonNullable
}

# FIXME: remove once everything imports instead of using global
window.laroute ?= laroute

window.StoreCheckout = StoreCheckout
