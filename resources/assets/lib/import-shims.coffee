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

import { BackToTop } from 'back-to-top'
import { PlayDetailList } from 'play-detail-list'
import { PlayDetailMenu } from 'play-detail-menu'
import { ReportComment } from 'report-comment'
import { ReportUser } from 'report-user'
import { ScoreHelper } from 'score-helper'
import { SelectOptions } from 'select-options'
import { SpotlightSelectOptions } from 'spotlight-select-options'
import { activeKeyDidChange, ContainerContext, KeyContext } from 'stateful-activation-context'
import { StoreCheckout } from 'store-checkout'
import { UserCard } from 'user-card'
import { UserCardStore } from 'user-card-store'
import { UserCardTooltip } from 'user-card-tooltip'
import Promise from 'promise-polyfill'
import TextareaAutosize from 'react-autosize-textarea'
import VirtualList from 'react-virtual-list'
import GalleryContest from 'gallery-contest'
import WindowVHPatcher from 'window-vh-patcher'

# polyfill non-Edge IE
window.Promise ?= Promise

window._exported = {
  activeKeyDidChange
  BackToTop
  ContainerContext
  GalleryContest
  KeyContext
  PlayDetailList
  PlayDetailMenu
  ReportComment
  ReportUser
  ScoreHelper
  SelectOptions
  SpotlightSelectOptions
  WindowVHPatcher
  UserCard
  UserCardStore
  UserCardTooltip
}

# refer to variables.less
window._styles =
  header:
    height: 90 # @nav2-height
    heightSticky: 50 # @nav2-height--pinned
    heightMobile: 60 # @navbar-height

window.StoreCheckout = StoreCheckout
window.TextareaAutosize = TextareaAutosize
window.VirtualList = VirtualList
