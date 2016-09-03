###
# Copyright 2016 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community
# osu!web is free software: yocontributions to the core ecosystem of osu!.
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
{div, p, span, hr, a, label, input} = React.DOM
el = React.createElement

class BeatmapsetPage.Details extends React.Component
  constructor: (props) ->
    super props

    @state =
      noVideo: false

  render: ->
    dateFormat = 'MMM D, YYYY'

    div className: 'page-contents__content beatmapset-details',
      div className: 'beatmapset-details__avatar-container',
        div
          className: 'beatmapset-details__avatar avatar avatar--beatmapset'
          style:
            backgroundImage: "url(#{@props.beatmapset.user.data.avatarUrl})"

      div
        className: 'beatmapset-details__mapper'
        dangerouslySetInnerHTML:
          __html: osu.trans 'beatmaps.beatmapset.show.details.made-by',
          user: laroute.link_to_route 'users.show', @props.beatmapset.user.data.username, users: @props.beatmapset.user.data.id,
            class: 'beatmapset-details__mapper beatmapset-details__mapper--username'

      div className: 'beatmapset-details__date',
        osu.trans 'beatmaps.beatmapset.show.details.submitted'
        moment(@props.beatmapset.submitted_date).format dateFormat

      if @props.beatmapset.ranked_date
        div className: 'beatmapset-details__date',
          osu.trans 'beatmaps.beatmapset.show.details.ranked'
          moment(@props.beatmapset.ranked_date).format dateFormat

      hr className: 'beatmapset-details__line'

      div className: 'beatmapset-details__download',
        if _.isEmpty currentUser
          div {},
            p
              className: 'beatmapset-details__text beatmapset-details__text--logged-out'
              'You need to log in before downloading any beatmaps!'

            a
              href: '#'
              className: 'beatmapset-details__button js-user-link'
              osu.trans 'users.anonymous.login_link'
        else
          div {},
            a
              href: if currentUser.isSupporter then Url.beatmapDownloadDirect @props.beatmapset.id else laroute.route 'support-the-game'
              className: 'beatmapset-details__button'
              osu.trans 'beatmaps.beatmapset.show.details.download.direct'
            a
              href: Url.beatmapDownload @props.beatmapset.id, !@state.noVideo
              className: 'beatmapset-details__button'
              osu.trans 'beatmaps.beatmapset.show.details.download.normal'

            if @props.beatmapset.video
              div className: 'beatmapset-details__novideo',
                label className: 'osu-checkbox',
                  input
                    className: 'osu-checkbox__input'
                    type: 'checkbox'
                    checked: @state.noVideo
                    onChange: (e) => @setState noVideo: e.target.checked

                  span className: 'osu-checkbox__tick',
                    el Icon, name: 'check'

                div className: 'beatmapset-details__text',
                  osu.trans 'beatmaps.beatmapset.show.details.download.no-video'
