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

{div, span, a, time} = ReactDOMFactories
el = React.createElement

bn = 'beatmapset-mapping'
dateFormat = 'LL'

class @BeatmapsetMapping extends React.PureComponent
  render: =>
    user = @props.user ? @props.beatmapset.user


    div className: bn,
      if user.id?
        a
          href: laroute.route 'users.show', user: user.id
          className: 'avatar avatar--beatmapset'
          style:
            backgroundImage: osu.urlPresence(user.avatar_url)
      else
        span className: 'avatar avatar--beatmapset avatar--guest'

      div className: "#{bn}__content",
        div
          className: "#{bn}__mapper"
          dangerouslySetInnerHTML:
            __html: osu.trans 'beatmapsets.show.details.mapped_by',
              mapper: @userLink(user)

        @renderDate 'submitted', 'submitted_date'

        if @props.beatmapset.ranked > 0
          @renderDate @props.beatmapset.status, 'ranked_date'
        else
          @renderDate 'updated', 'last_updated'


  renderDate: (key, attribute) =>
    div null,
      osu.trans "beatmapsets.show.details.#{key}"
      time
        className: "#{bn}__date js-tooltip-time"
        dateTime: @props.beatmapset[attribute]
        title: @props.beatmapset[attribute]
        moment(@props.beatmapset[attribute]).format dateFormat


  userLink: (user) ->
    if user.id?
      laroute.link_to_route 'users.show',
        user.username
        { user: user.id }
        class: "#{bn}__user js-usercard"
        'data-user-id': user.id
    else
      "<span class='#{bn}__user'>#{_.escape(user.username ? osu.trans('users.deleted'))}</span>"
