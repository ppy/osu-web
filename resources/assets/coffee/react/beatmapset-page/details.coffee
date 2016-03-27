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
{div, p, span, hr, a} = React.DOM
el = React.createElement

class BeatmapSetPage.Details extends React.Component
  constructor: (props) ->
    super props

    @state =
      video: true

  toggleVideo: =>
    console.log 'boom'
    @setState (state, props) =>
      video: !state.video

  render: ->
    div className: 'page-contents__content beatmapset-details',
      div className: 'beatmapset-details__avatar-container',
        div
          className: 'beatmapset-details__avatar avatar avatar--beatmapset'
          style:
            backgroundImage: "url(#{@props.set.avatarUrl})"

      div className: 'beatmapset-details__mapper',
        Lang.get 'beatmaps.beatmapset.show.contents.made-by'
        span className: 'beatmapset-details__mapper beatmapset-details__mapper--username', @props.set.creator

      div className: 'beatmapset-details__date',
        Lang.get 'beatmaps.beatmapset.show.contents.submitted'
        @props.set.submitted

      div className: 'beatmapset-details__date',
        Lang.get 'beatmaps.beatmapset.show.contents.ranked'
        @props.set.ranked

      hr className: 'beatmapset-details__line'

      div className: 'beatmapset-details__download',
        if _.isEmpty currentUser
          div {},
            p
              className: 'beatmapset-details__text beatmapset-details__text--logged-out'
              'You need to log in before downloading any beatmaps!'

            a
              href: '#'
              className: 'beatmapset-details__button'
              'data-target': '#user-dropdown-modal'
              'data-toggle': 'modal'
              Lang.get 'users.anonymous.login_link'
        else
          div {},
            a
              href: if currentUser.isSupporter then Url.beatmapDownloadDirect @props.set.beatmapset_id else Url.support
              className: 'beatmapset-details__button'
              Lang.get 'beatmaps.beatmapset.show.contents.download.direct'
            a
              href: Url.beatmapDownload @props.set.beatmapset_id, @state.video
              className: 'beatmapset-details__button'
              Lang.get 'beatmaps.beatmapset.show.contents.download.normal'

            if @props.set.video
              div onClick: @toggleVideo,
                el BeatmapSetPage.NoVideoCheckbox,
                  enabled: @state.video
