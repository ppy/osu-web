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

  window.FilterSelector = React.createClass({
    propTypes: {
      title: React.PropTypes.string.isRequired,
      options: React.PropTypes.objectOf(React.PropTypes.string).isRequired,
      selected: React.PropTypes.arrayOf(React.PropTypes.number),
      multiselect: React.PropTypes.bool
    },
    getDefaultProps: function() {
      return {
        multiselect: false,
        selected: [],
        default: []
      };
    },
    getInitialState: function() {
      return({selected: [].concat(this.props.default)});
    },
    select: function(i) {
      if (this.selected(i)) {
        if (this.props.multiselect) {
          this.setState({selected: _.without(this.state.selected, i)}, this.triggerUpdate);
        } else {
          this.setState({selected: [].concat(this.props.default)}, this.triggerUpdate);
        }
      } else {
        if (this.props.multiselect) {
          this.setState({selected: this.state.selected.concat(i)}, this.triggerUpdate);
        } else {
          this.setState({selected: [i]}, this.triggerUpdate);
        }
      }
    },
    triggerUpdate: function() {
      var payload = {name: this.props.name, value: this.props.multiselect ? this.state.selected : this.state.selected[0]};
      $(document).trigger('beatmap:search:filtered', payload);
    },
    selected: function(i) {
      return $.inArray(i, this.state.selected) > -1;
    },
    render: function() {
      var selectors = [];
      $.each(this.props.options, function(i,e){
        selectors.push(
          <a href='#' className={this.selected(e['id']) ? 'active' : ''} value={e['id']} onClick={this.select.bind(this, e['id'])}>{e['name']}</a>
        );
      }.bind(this));
      return(
        <div id={this.props.id} className='selector' data-name={this.props.name}>
          <span className='header'>{this.props.title}</span>
          {selectors}
        </div>
      );
    }
  });
}).call(this)
