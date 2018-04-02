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
    userURL = laroute.route 'users.show', user: user.id

    div className: bn,
      a
        href: userURL
        className: 'avatar avatar--beatmapset'
        style:
          backgroundImage: "url(#{user.avatar_url})"

      div className: "#{bn}__content",
        div className: "#{bn}__mapper",
          osu.trans 'beatmapsets.show.details.made-by'
          a
            className: "#{bn}__user js-usercard"
            'data-user-id': user.id
            href: userURL
            user.username

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
