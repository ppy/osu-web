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

  require('./filter_selector.jsx');

  window.SearchPanel = React.createClass({
    keyDelay: null,
    prevText: null,
    search_url: "/beatmaps/search",
    getInitialState: function() {
      return({filters: JSON.parse(document.getElementById('json-filters').text)['data']});
    },
    keypressed: function() {
      var text = $('#searchbox').val();
      if (text == null || text == "" || text == this.prevText)
        return;

      this.prevText = text;

      if (this.keyDelay != null)
        clearTimeout(this.keyDelay);

      this.keyDelay = setTimeout(this.submit, 500);
    },
    submit: function() {
      var searchText = this.prevText;
      $(document).trigger('beatmap:search:start');
    },
    componentDidMount: function() {
      $('#searchbox').on('keyup', this.keypressed);
    },
    componentWillUnmount: function() {
      $('#searchbox').off('keyup');
    },
    show_more: function() {
      $('#search').addClass('expanded');
      return false;
    },
    render: function() {
      var filters = this.state.filters;
      return(
        <div id='search'>
          <div className='background' style={{'background-image': 'url("' + this.props.background + '")'}}></div>
          <div className='box'>
            <input id="searchbox" type='textbox' name='search' placeholder={Lang.get("beatmaps.listing.search.prompt")}></input>
            <i className='fa fa-search'></i>
          </div>

          <FilterSelector name='mode' title='Mode' options={filters.modes} default={0} />
          <FilterSelector name='status' title='Rank Status' options={filters.statuses} default={0} />

          <div className='more'>
            <a className='toggle' href='#' onClick={this.show_more}>
              <div>{Lang.get('beatmaps.listing.search.options')}</div>
              <div><i className='fa fa-angle-down'></i></div>
            </a>
            <FilterSelector name='genre' title='Genre' options={filters.genres} default={filters.genres[0]['id']} />
            <FilterSelector name='language' title='Language' options={filters.languages} default={filters.languages[0]['id']} />
            <FilterSelector name='extra' title='Extra' options={filters.extras} multiselect={true} />
            <FilterSelector name='rank' title='Rank Achieved' options={filters.ranks} default={null} />
          </div>
        </div>
      );
    }
  });
}).call(this)
