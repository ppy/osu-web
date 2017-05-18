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

{div, a, li, span, ul, hr} = React.DOM

class @Tabs extends React.Component
  render: =>
    div null,
      ul className: 'page-mode page-mode--ranking-page-mode-tabs',
        for name, tab of @props.tabs
          active = name == @props.currentTab

          linkClass = 'page-mode-link page-mode-link--white'
          linkClass += ' page-mode-link--is-active' if active

          li
            className: 'page-mode__item'
            key: name
            if tab.disabled
              linkClass += ' page-mode-link--is-disabled'
              span
                  className: linkClass
                  title: 'coming soon!™'
                  tab.title
            else
              a
                className: linkClass
                onClick: @switchMode
                href: @props.hrefFunc?(name) ? '#'
                'data-tab': name
                tab.title
                span className: 'page-mode-link__stripe page-mode-link__stripe--black'

      hr className: 'page-mode__underline'


  switchMode: (e) =>
    e.preventDefault()
    tab = e.target.dataset.tab

    return if @props.currentTab == tab || !tab?

    $.publish "tabs:switch:#{@props.name}", tab: tab
