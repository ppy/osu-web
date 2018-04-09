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

{div, ul, li, a, span} = ReactDOMFactories
el = React.createElement

ProfilePage.Header = (props) ->
  div null,
    div
      className: 'osu-page osu-page--users-show-header'
      if !props.user.is_bot
        ul className: 'page-mode',
          for mode in BeatmapHelper.modes
            linkClass = 'page-mode-link'
            linkClass += ' page-mode-link--is-active' if mode == props.currentMode

            li
              className: 'page-mode__item'
              key: mode
              a
                className: linkClass
                href: laroute.route 'users.show',
                  user: props.user.id
                  mode: mode
                osu.trans "beatmaps.mode.#{mode}"
                if props.user.playmode == mode
                  span className: 'page-mode__item-icon',
                    '\u00A0'
                    el Icon,
                      name: 'star'
                      title: osu.trans('users.show.edit.default_playmode.is_default_tooltip')
                span className: 'page-mode-link__stripe'

      el ProfilePage.HeaderMain, props
    el ProfilePage.HeaderExtra, props
