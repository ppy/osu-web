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

  window.AutoPager = {
    autoPagerOnScroll: function(e) {
      if (this.autoPagerTarget == 'undefined' || this.autoPagerTarget[0].getBoundingClientRect().top > document.documentElement.clientHeight + this.autoPagerTriggerDistance)
        return;

      $(document).trigger('beatmap:load_more');
    },

    componentDidMount: function() {
      this.autoPagerScrollHandle = $(window).on('scroll', _.throttle(this.autoPagerOnScroll, 500));
    },
    componentWillUnmount: function() {
      $(window).off(this.autoPagerScrollHandle);
    }
  };

  window.Paginator = React.createClass({
    mixins: [AutoPager],

    autoPagerTriggerDistance: 3000,
    clicked: function(e) {
      e.preventDefault();
      $(document).trigger('beatmap:load_more');
    },
    componentDidMount: function() {
      this.autoPagerTarget = $('#js-beatmaps-load-more');
    },
    render: function() {
      return(
        <div className={"beatmaps-load-more " + (this.props.paging.loading ? 'loading ' : '') + (this.props.paging.more ? '' : 'no_more')}>
          <a href={this.props.paging.url} id="js-beatmaps-load-more" data-mode="next" onClick={this.clicked}>Load more</a>
          <span>loading... <i class="fa fa-refresh fa-spin"></i></span>
        </div>
      );
    }
  });
}).call(this)
