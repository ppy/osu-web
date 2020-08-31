# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Main } from './mp-history/main'

reactTurbolinks.register 'mp-history', Main, ->
  events: osu.parseJson('json-events')
