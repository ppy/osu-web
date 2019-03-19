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

import { createElement as el, Fragment, PureComponent } from 'react'
import { a } from 'react-dom-factories'
import { PopupMenu } from 'popup-menu'
import { ReportScore } from 'report-score'

export class PlayDetailMenu extends PureComponent
  render: ->
    { onHide, onShow, score, } = @props
    el PopupMenu,
      items: (toggle) ->
        el Fragment, null,
          if score.replay
            a
              className: 'simple-menu__item js-login-required--click'
              href: laroute.route 'scores.download',
                      mode: score.mode
                      score: score.id
              'data-turbolinks': false
              onClick: toggle
              osu.trans 'users.show.extra.top_ranks.download_replay'

          if currentUser.id? && score.user_id != currentUser.id
            el ReportScore,
              { score }
      onHide: onHide
      onShow: onShow
