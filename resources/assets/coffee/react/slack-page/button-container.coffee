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
{div, p, button, a} = React.DOM

class SlackPage.ButtonContainer extends React.Component
  constructor: (props) ->
    super props

    @state =
      accepted: @props.accepted

  sendInviteRequest: =>
    return unless @props.isEligible

    osu.showLoadingOverlay()

    $.ajax Url.requestSlackInvite,
      method: 'POST',
      dataType: 'JSON'

    .done () =>
      @setState accepted: true

    .fail (xhr) =>
      osu.ajaxError xhr

    .always osu.hideLoadingOverlay

  render: ->
    issuesClasses = 'slack-button-container__issues'
    buttonClasses = 'btn-osu slack-button-container__button'

    if @props.isEligible
      issuesClasses += ' slack-button-container__issues--hidden'
      buttonClasses += ' btn-osu-default'
    else
      buttonClasses += ' disabled'

    div className: 'slack-button-container',
      if _.isEmpty currentUser
        p className: 'slack-button-container__notice',
          Lang.get 'community.slack.guest-begin'
          a
            href: '#'
            'data-target': '#user-dropdown-modal',
            'data-toggle': 'modal',
            title: Lang.get 'users.anonymous.login-link'
            Lang.get 'community.slack.guest-middle'
          Lang.get 'community.slack.guest-end'

      else if @state.accepted
        if @props.isInviteAccepted
          p
            className: 'slack-button-container__notice',
            dangerouslySetInnerHTML: { __html: Lang.get('community.slack.invite-already-accepted', mail: @props.supportMail) }

        else
          p className: 'slack-button-container__notice slack-button-container__notice--accepted',
            Lang.get 'community.slack.accepted'
      else
        div className: '',
          p
            className: issuesClasses,
            dangerouslySetInnerHTML: { __html: Lang.get('community.slack.recent-issues', mail: @props.supportMail) }
          button className: buttonClasses, onClick: @sendInviteRequest,
            Lang.get 'community.slack.agree-button'
