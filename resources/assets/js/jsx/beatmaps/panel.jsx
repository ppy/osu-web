/**
*    Copyright 2015 ppy Pty. Ltd.
*
*    This file is part of osu!web. osu!web is distributed with the hope of
*    attracting more community contributions to the core ecosystem of osu!.
*
*    osu!web is free software: you can redistribute it and/or modify
*    it under the terms of the Affero GNU General Public License as published by
*    the Free Software Foundation, either version 3 of the License, or
*    (at your option) any later version.
*
*    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
*    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*    See the GNU Affero General Public License for more details.
*
*    You should have received a copy of the GNU Affero General Public License
*    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
*
*/
;(function() {
  'use strict';

  require('./icon.jsx');

  window.Panel = React.createClass({
    render: function() {
      var beatmap = this.props.beatmap;

      var difficulties = [];
      if (beatmap.difficulties.length > 0) {
        if (beatmap.difficulties.length > 5) {
          difficulties.push(<BeatmapDifficultyIcon difficulty={beatmap.difficulties[0]} />);
          difficulties.push(<span>{beatmap.difficulties.length - 1}</span>);
        } else {
          for (var i = 0; i < beatmap.difficulties.length; i++) {
            difficulties.push(<BeatmapDifficultyIcon difficulty={beatmap.difficulties[i]} />);
          }
        }
      }

      return (
        <div href={'/beatmaps/modding/'+beatmap.beatmapset_id} className='beatmap object_link shadow-hover' objectid={beatmap.beatmapset_id}>
          <div className='panel'>
            <div className='thumb' style={{'background-image': 'url("//b.ppy.sh/thumb/'+beatmap.beatmapset_id+'l.jpg")'}}></div>
            <div className='thumb_cover' style={{'background-image': 'url("//b.ppy.sh/thumb/'+beatmap.beatmapset_id+'l.jpg")'}}></div>
            <div className="bottom_left">
              <div className='title'>
                <span title={beatmap.title}>{beatmap.title}</span>
              </div>
              <div className='artist'>
                <span title={beatmap.artist}>{beatmap.artist}</span>
              </div>
            </div>

            <div className="top_right">
              <div className='stats'>
                <div className='plays'>
                  <span title={beatmap.play_count}>
                    {beatmap.play_count}
                  </span>
                  <i className='fa fa-play-circle'></i>
                </div>

                <div className='favourites'>
                  <span title={beatmap.favourite_count}>
                    {beatmap.favourite_count}
                  </span>
                  <i className='fa fa-heart'></i>
                </div>
              </div>
            </div>
          </div>

          <div className='bottom_left'>
            <span className="hidden" ref={beatmap.beatmapset_id}>
              {beatmap.beatmapset_id}
            </span>

            <div className='creator'
              dangerouslySetInnerHTML={{ __html:
                Lang.get('beatmaps.listing.mapped-by', {
                  mapper:
                    React.renderToStaticMarkup(
                      <a href={'/u/'+beatmap.user_id}>{beatmap.creator}</a>
                    )
                })
              }} />

            <div className='source'>
              {beatmap.source}
            </div>
          </div>

          <div className="bottom_right show_on_hover">
            <a href='#' className="object_link"><i className="fa fa-download"></i></a>
            <a href='#' className="object_link"><i className="fa fa-comments-o"></i></a>
            <a href='#' className="object_link"><i className='fa fa-heart'></i></a>
          </div>

          <div className='difficulties'>
            {difficulties}
          </div>

          <paper-shadow z="1" animated="true"></paper-shadow>
        </div>
      );
    }
  });
}).call(this)
