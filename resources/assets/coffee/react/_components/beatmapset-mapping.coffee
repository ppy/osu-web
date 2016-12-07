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
{div, span, a, ol, li} = React.DOM
el = React.createElement

bn = 'beatmapset-mapping'

@BeatmapsetMapping = ({user, beatmapset, beatmap}) ->
  dateFormat = 'MMM D, YYYY'
  user ?= beatmapset.user

  div className: bn,
    div
      className: 'avatar avatar--beatmapset'
      style:
        backgroundImage: "url(#{user.avatarUrl})"

    div className: "#{bn}__content",
      div className: "#{bn}__mapper",
        osu.trans 'beatmaps.beatmapset.show.details.made-by'
        a
          className: "#{bn}__user"
          href: laroute.route 'users.show', user: user.id
          user.username

      div null,
        osu.trans 'beatmaps.beatmapset.show.details.submitted'
        span
          className: "#{bn}__date"
          moment(beatmapset.submitted_date).format dateFormat

      if beatmap.ranked > 0
        div null,
          osu.trans "beatmaps.beatmapset.show.details.#{beatmap.status}"
          span
            className: "#{bn}__date"
            moment(beatmapset.ranked_date).format dateFormat
      else
        div null,
          osu.trans 'beatmaps.beatmapset.show.details.updated'
          span
            className: "#{bn}__date"
            moment(beatmap.last_updated).format dateFormat
