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

{span} = ReactDOMFactories
el = React.createElement

class ProfilePage.ExtraTab extends React.PureComponent
  render: =>
    className = 'page-mode-link'

    if @props.page == @props.currentPage
      className += ' page-mode-link--is-active'

    span
      className: className
      span
        className: 'fake-bold'
        'data-content': osu.trans("users.show.extra.#{@props.page}.title")
        osu.trans("users.show.extra.#{@props.page}.title")
      span className: 'page-mode-link__stripe'
