# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { pageChange } from 'utils/page-change'

$(document).on 'click', '.js-spoilerbox__link', (e) ->
  e.preventDefault()

  $link = $(e.target).closest('.js-spoilerbox')

  $link.toggleClass 'js-spoilerbox--open'
  pageChange()
