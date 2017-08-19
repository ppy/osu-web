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

{div, span, a, ol, li} = ReactDOMFactories
el = React.createElement

bn = 'beatmapset-mapping'

@BeatmapsetMapping = ({user, beatmapset}) ->
  dateFormat = 'LL'
  user ?= beatmapset.user

  div className: bn,
    div
      className: 'avatar avatar--beatmapset'
      style:
        backgroundImage: "url(#{user.avatar_url})"

    div className: "#{bn}__content",
      div className: "#{bn}__mapper",
        osu.trans 'beatmapsets.show.details.made-by'
        a
          className: "#{bn}__user"
          href: laroute.route 'users.show', user: user.id
          user.username

      div null,
        osu.trans 'beatmapsets.show.details.submitted'
        span
          className: "#{bn}__date"
          moment(beatmapset.submitted_date).format dateFormat

      if beatmapset.ranked > 0
        div null,
          osu.trans "beatmapsets.show.details.#{beatmapset.status}"
          span
            className: "#{bn}__date"
            moment(beatmapset.ranked_date).format dateFormat
      else
        div null,
          osu.trans 'beatmapsets.show.details.updated'
          span
            className: "#{bn}__date"
            moment(beatmapset.last_updated).format dateFormat
