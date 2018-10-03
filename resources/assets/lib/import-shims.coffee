###
#    Copyright 2015-2017 ppy Pty. Ltd.
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
import { ReportForm } from 'report-form'
import { SelectOptions } from 'select-options'
import { SpotlightSelectOptions } from 'spotlight-select-options'
import { StoreCheckout } from 'store-checkout'
import Promise from 'promise-polyfill'
import TextareaAutosize from 'react-autosize-textarea'
import VirtualList from 'react-virtual-list'

# polyfill non-Edge IE
window.Promise ?= Promise

window._exported = {
  BackToTop
  PlayDetailList
  ReportForm
  SelectOptions
  SpotlightSelectOptions
}

window.StoreCheckout = StoreCheckout
window.TextareaAutosize = TextareaAutosize
window.VirtualList = VirtualList
