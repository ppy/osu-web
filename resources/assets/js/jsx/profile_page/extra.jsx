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

	_modeSwitch: function() {
		$(document).trigger('profile-extra.mode.switch', this.props.mode);
	},

	render: function() {
		return (
			<li onClick={this._modeSwitch} className={this._className()}>
				{Lang.get(`users.show.extra.${this.props.mode}.title`)}
			</li>
		);
	},
});

var RecentActivities = React.createClass({
	_renderEntry: function(event) {
		if (event.type === 'rank') {
			return (
				<li className='event-entry' key={event.id}>
					<div className='event-entry__detail'>
						<div className={`flex-none profile-score-rank-badge profile-score-rank-badge--${event.scoreRank} profile-score-rank-badge--small`} />
						<div className='event-entry__text' dangerouslySetInnerHTML={{ __html: Lang.get('events.rank', {
							user: osu.link(event.user.url, event.user.username),
							rank: event.rank,
							beatmap: osu.link(event.beatmap.url, event.beatmap.title),
						}) }} />
					</div>
					<div className='event-entry__time' dangerouslySetInnerHTML={{ __html: osu.timeago(event.created_at) }} />
				</li>
			);
		} else {
			return;
			return (
				<li key={event.id}>
					<pre>{JSON.stringify(event)}</pre>
				</li>
			);
		};
	},

	getInitialState: function() {
		return {
			recentActivities: JSON.parse(document.getElementById('json-user-recent-activities').text).data,
		};
	},

	render: function() {
		return (
			<div className='row-page profile-extra'>
				<h2 className='profile-extra-title'>{Lang.get('users.show.extra.recent_activities.title')}</h2>
				<ul className='profile-recent-activities'>
					{this.state.recentActivities.map(function(activity) {
						return this._renderEntry(activity);
					}, this)}
				</ul>
			</div>
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

		$(document).off('profile-extra');
		$(document).on('profile-extra.mode.switch', this._modeSwitch);
	},

	componentWillUnmount: function() {
		$(document).off('profile-extra');
	},

	componentWillReceiveProps: function() {
		setTimeout(function() {
			$(document).trigger('osu:page:change');
		}, 0);
	},

	_modeSwitch: function(_e, newMode) {
		this.setState({ mode: newMode });
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

				<RecentActivities />
			</div>
		);
	}
});
