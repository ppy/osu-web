###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
{button, div, nav, p, a, img} = React.DOM
el = React.createElement

class @Landing.Page extends React.Component
  render: ->
    nav className: "osu-layout__section osu-layout__section--minimum",
      div className: "osu-layout__row landing-nav",
        div className: "landing-nav__section",
          a 
            className: "landing-nav__section__link landing-nav__section__link--bold"
            href: "#"
            Lang.get('layout.menu.home._')

          a
            className: "landing-nav__section__link"
            href: "#"
            Lang.get('layout.menu.community._')

          a
            className: "landing-nav__section__link"
            href: "#"
            Lang.get('layout.menu.help._')

          a
            className: "landing-nav__section__link"
            href: "#"
            Lang.get('layout.menu.store._')

        div className: "landing-nav__center",
          img 
            className: "landing-nav__logo-wrapper__logo"
            src: "/images/layout/osu-logo@2x.png"
            alt: "osu!"

        div className: "landing-nav__section landing-nav__section--right",
          a
            className: "landing-nav__section__link"
            href: "#"
            Lang.get('users.login._')

          a
            className: "landing-nav__section__link"
            href: "#"
            Lang.get('users.signup._')