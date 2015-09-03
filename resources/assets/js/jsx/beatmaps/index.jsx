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

  require('./panel.jsx');

  var beatmaps = JSON.parse(document.getElementById('json-beatmaps').text);

  window.SearchPanel = React.createClass({
    render: function() {
      return(
        <div id='search' className='search'>
          <div className='box'>
            <input type='textbox' name='search' placeholder={Lang.get("beatmaps.listing.search.prompt")}>
            <i className='fa fa-search'></i></input>
          </div>

          <div className='selector'>
            <span className='header'>Mode</span>
            <a href='#' className='active'>{Lang.get("beatmaps.listing.all")}</a>
            <a href='#'>osu!</a>
            <a href='#'>Taiko</a>
            <a href='#'>Catch the Beat</a>
            <a href='#'>osu!mania</a>
          </div>

          <div className='selector'>
            <span className='header'>Rank Status</span>
            <a href='#' className='active'>{Lang.get("beatmaps.listing.ranked-approved")}</a>
            <a href='#'>{Lang.get("beatmaps.listing.faves")}</a>
            <a href='#'>{Lang.get("beatmaps.listing.modreqs")}</a>
            <a href='#'>{Lang.get("beatmaps.listing.pending")}</a>
            <a href='#'>{Lang.get("beatmaps.listing.all")}</a>
          </div>

          <div className='more gray_link'>
            <a href='#'>
              <div>{Lang.get("beatmaps.listing.search.options")}</div>
              <div><i className='fa fa-angle-down'></i></div>
            </a>
          </div>
        </div>
      );
    }
  });

  window.Beatmaps = React.createClass({
    getInitialState: function() {
      return {
        // beatmaps: this.props.beatmaps
      };
    },

    unlistenAll: function() {
    },

    listenAll: function() {
      this.unlistenAll();
    },

    componentDidMount: function() {
      this.listenAll();
    },

    componentWillUnmount: function() {
      this.unlistenAll();
    },

    render: function() {
      var
        beatmaps = [],
        beatmap_data = JSON.parse(document.getElementById('json-beatmaps').text)['data'];
        for (var i = 0; i < beatmap_data.length; i++) {
          beatmaps.push(<Panel beatmap={beatmap_data[i]} />);
        }
      return (
        <div id='beatmaps' class='beatmaps padding'>
          {beatmaps}
        </div>
      );
    }
  });

  React.render(
    <div>
      <SearchPanel />
      <Beatmaps beatmaps={beatmaps} />
    </div>,
    document.getElementsByClassName('content')[0]
  );
}).call(this)
