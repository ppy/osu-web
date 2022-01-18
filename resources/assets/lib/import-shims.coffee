# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

# Import shim so that globally declared scripts can work without changes.

import { parseJson, parseJsonNullable } from 'utils/json'
import { pageChange, pageChangeImmediate } from 'utils/page-change'

window._exported = {
  pageChange
  pageChangeImmediate
  parseJson
  parseJsonNullable
}
