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
'use strict';

var Tab = React.createClass({
	_className: function() {
		var className = 'profile-extra-tab';

		if (this.props.mode === this.props.currentMode) {
			className += ' profile-extra-tab--active';
		}

		return className;
	},

	render: function() {
		return (
			<li className={this._className()}>{Lang.get(`users.show.extra.${this.props.mode}`)}</li>
		);
	},
});

module.exports = React.createClass({
	getInitialState: function() {
		return {
			mode: 'recent_activities',
		};
	},

	componentDidMount: function() {
		this.componentWillReceiveProps();
	},

	componentWillReceiveProps: function() {
		setTimeout(function() {
			$(document).trigger('osu:page:change');
		}, 0);
	},

	_switchMode: function() {
	},

	render: function() {
		var profileDetail;
		if (this.props.mode === 'me') {
			return;
		}

		return (
			<div className='content content-extra flex-full'>
				<ul className='profile-extra-tabs'>
				{['recent_activities', 'historical', 'beatmaps', 'kudosu', 'achievements'].map(function(m) {
					return <Tab key={m} mode={m} currentMode={this.state.mode} />;
				}, this)}
				</ul>

				<div className='row-page'>
					Here be extra contents.
				</div>
			</div>
		);
	}
});
