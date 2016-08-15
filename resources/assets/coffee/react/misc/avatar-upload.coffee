###
# Copyright 2015-2016 ppy Pty. Ltd.
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
{div, label, span, input} = React.DOM
el = React.createElement

class AvatarUpload extends React.Component
  constructor: (props) ->
    super props

    @state =
      avatarUrl: props.avatarUrl
      updating: false

  componentDidMount: ->
    $(@refs.fileUpload).fileupload
      url: laroute.route 'account.update-profile'
      submit: =>
        @setState updating: true
      done: (_e, data) =>
        @setState avatarUrl: data.result.data.avatarUrl
      fail: (_e, data) =>
        osu.ajaxError data.jqXHR
      complete: =>
        @setState updating: false

  componendWillUnmount: ->
    $(@refs.fileUpload).fileupload 'destroy'

  render: ->
    div className: 'user-prefs-section__right-section user-prefs-section__right-section--avatar',
      div
        className: 'avatar avatar--user-prefs'
        style:
          backgroundImage: "url(#{@state.avatarUrl})"

        div
          className: 'spinner-container'
          'data-state': 'enabled' if @state.updating
          div className: 'spinner',
            div className: 'spinner__cube'
            div className: 'spinner__cube spinner__cube--2'

      label className: 'btn-osu-big user-prefs-section__button fileupload', ref: 'uploadButtonContainer',
        div className: 'btn-osu-big__content',
          span className: 'user-prefs-section__button-text', osu.trans 'users.settings.upload'
          el Icon, name: 'angle-double-up'

        input className: 'fileupload__input', type: 'file', name: 'avatar_file', ref: 'fileUpload'


propsFunction = =>
  avatarUrl: osu.parseJson('json-avatar').avatarUrl

reactTurbolinks.register 'avatar-upload', AvatarUpload, propsFunction
