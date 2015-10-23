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
    },
    render: function() {
      var modeFilters = {
        "-1": Lang.get('beatmaps.mode.any'),
        "0":  Lang.get('beatmaps.mode.osu'),
        "1":  Lang.get('beatmaps.mode.taiko'),
        "2":  Lang.get('beatmaps.mode.catch'),
        "3":  Lang.get('beatmaps.mode.mania')
      };
      var statusFilters = {
        "-1": Lang.get('beatmaps.status.all'),
        "0":  Lang.get('beatmaps.status.ranked-approved'),
        "1":  Lang.get('beatmaps.status.approved'),
        "2":  Lang.get('beatmaps.status.faves'),
        "3":  Lang.get('beatmaps.status.modreqs'),
        "4":  Lang.get('beatmaps.status.pending'),
        "5":  Lang.get('beatmaps.status.graveyard'),
        "6":  Lang.get('beatmaps.status.my-maps')
      };
      var genreFilters = {
        "0": Lang.get('beatmaps.genre.any'),
        "1": Lang.get('beatmaps.genre.unspecified'),
        "2": Lang.get('beatmaps.genre.video-game'),
        "3": Lang.get('beatmaps.genre.anime'),
        "4": Lang.get('beatmaps.genre.rock'),
        "5": Lang.get('beatmaps.genre.pop'),
        "6": Lang.get('beatmaps.genre.other'),
        "7": Lang.get('beatmaps.genre.novelty'),
        "8": Lang.get('beatmaps.genre.hip-hop'),
        "9": Lang.get('beatmaps.genre.electronic')
      };
      var languageFilters = {
        "0": Lang.get('beatmaps.language.any'),
        "1": Lang.get('beatmaps.language.english'),
        "2": Lang.get('beatmaps.language.chinese'),
        "3": Lang.get('beatmaps.language.french'),
        "4": Lang.get('beatmaps.language.german'),
        "5": Lang.get('beatmaps.language.italian'),
        "6": Lang.get('beatmaps.language.japanese'),
        "7": Lang.get('beatmaps.language.korean'),
        "8": Lang.get('beatmaps.language.spanish'),
        "9": Lang.get('beatmaps.language.swedish'),
        "a": Lang.get('beatmaps.language.instrumental'),
        "b": Lang.get('beatmaps.language.other')
      };
      var extraFilters = {
        "0": Lang.get('beatmaps.extra.video'),
        "1": Lang.get('beatmaps.extra.storyboard')
      };
      var rankFilters = {
        "0": Lang.get('beatmaps.rank.any'),
        "1": Lang.get('beatmaps.rank.silver-ss'),
        "2": Lang.get('beatmaps.rank.ss'),
        "3": Lang.get('beatmaps.rank.silver-s'),
        "4": Lang.get('beatmaps.rank.s'),
        "5": Lang.get('beatmaps.rank.a'),
        "6": Lang.get('beatmaps.rank.b'),
        "7": Lang.get('beatmaps.rank.c'),
        "8": Lang.get('beatmaps.rank.d')
      };
      return(
        <div id='search'>
          <div className='background' style={{'background-image': 'url("' + this.props.background + '")'}}></div>
          <div className='box'>
            <input id="searchbox" type='textbox' name='search' placeholder={Lang.get("beatmaps.listing.search.prompt")}></input>
            <i className='fa fa-search'></i>
          </div>

          <FilterSelector id='modeSelector' name='mode' title='Mode' options={modeFilters} default={"0"} />
          <FilterSelector id='statusSelector' name='status' title='Rank Status' options={statusFilters} default={"1"} />

          <div className='more'>
            <a className='toggle' href='#' onClick={this.show_more}>
              <div>{Lang.get('beatmaps.listing.search.options')}</div>
              <div><i className='fa fa-angle-down'></i></div>
            </a>
            <FilterSelector id='genreSelector' name='genre' title='Genre' options={genreFilters} default={"0"} />
            <FilterSelector id='languageSelector' name='language' title='Language' options={languageFilters} default={"0"} />
            <FilterSelector id='extraSelector' name='extra' title='Extra' options={extraFilters} multiselect={true} />
            <FilterSelector id='rankSelector' name='rank' title='Rank Achieved' options={rankFilters} default={"0"} />
          </div>
        </div>
      );
    }
  });
}).call(this)
