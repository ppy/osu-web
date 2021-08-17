# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { div, h2, i, span } from 'react-dom-factories'
el = React.createElement

export ExtraHeader = (props) ->
  div className: 'u-relative',
    h2 className: 'title title--page-extra', osu.trans("users.show.extra.#{props.name}.title")
    if props.withEdit
      span className: 'page-extra-dragdrop hidden-xs js-profile-page-extra--sortable-handle',
        i className: 'fas fa-bars'
