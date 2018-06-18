###
#    Copyright 2015-2018 ppy Pty. Ltd.
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

el = React.createElement
{div} = ReactDOMFactories

bn = 'notification-banner'

@NotificationBanner = ({type, title, message}) ->
  div className: "#{bn} #{bn}--#{type}",
    div className: "#{bn}__icon"
    div className: "#{bn}__icon-label", type.toUpperCase()
    div className: "#{bn}__text", title
    div className: "#{bn}__text", message
    div className: "#{bn}__light-bar"
