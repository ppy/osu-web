###*
*    Copyright 2015 ppy Pty. Ltd.
*
*    This file is part of osu!web. osu!web is distributed with the hope of
*    attracting more community contributions to the core ecosystem of osu!.
*
*    osu!web is free software: you can redistribute it and/or modify
*    it under the terms of the Affero GNU General Public License version 3
*    as published by the Free Software Foundation.
*
*    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
*    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*    See the GNU Affero General Public License for more details.
*
*    You should have received a copy of the GNU Affero General Public License
*    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
*
###

{div, table, thead, tbody, tr, th} = React.DOM
el = React.createElement

class @Tracklist extends React.Component
  render: ->
    return null unless @props.tracks.length > 0

    tracks = @props.tracks.map (track) =>
      el TracklistTrack,
        key: track.id,
        track: track,

    div className: 'trackplayer',
      table className: 'trackplayer__table trackplayer__table--smaller',
        thead {},
            tr className: 'trackplayer__row--header',
                th className: 'trackplayer__col', ''
                th className: 'trackplayer__col trackplayer__col--title', 'title'
                th className: 'trackplayer__col', 'length'
                th className: 'trackplayer__col', 'bpm'
                th className: 'trackplayer__col', 'genre'
                th className: 'trackplayer__col trackplayer__col--dl',
        tbody {}, tracks
