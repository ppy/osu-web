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
{button, div, form, input, textarea} = React.DOM
el = React.createElement

bn = 'beatmap-discussions-new-post'

BeatmapDiscussions.NewPost = React.createClass
  mixins: [React.addons.PureRenderMixin]


  getInitialState: ->
    message: ''
    timestamp: ''


  setTimestamp: (e) ->
    @setState timestamp: e.target.value


  setMessage: (e) ->
    @setState message: e.target.value


  render: ->
    form
      className: bn
      div className: "#{bn}__col #{bn}__col--left",
        div className: "#{bn}__timestamp-box",
          input
            className: "#{bn}__input #{bn}__input--timestamp",
            type: 'text'
            value: @state.timestamp
            onChange: @setTimestamp

      div className: "#{bn}__col #{bn}__col--main",
        div className: "#{bn}__message-box",
          div
            className: "#{bn}__avatar"
            div
              className: 'avatar avatar--full-rounded'
              style:
                backgroundImage: "url('#{@props.user.avatarUrl}')"
          textarea
            className: "#{bn}__message"
            value: @state.message
            onChange: @setMessage

      div className: "#{bn}__col #{bn}__col--right",
        button
          className: "#{bn}__button"
          Lang.get('common.buttons.post')
