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

	require('./profile_page/header.jsx');
	require('./profile_page/contents.jsx');
	require('./profile_page/contents_extra.jsx');

	var
		stats = JSON.parse(document.getElementById('json-user-stats').text),
		userInfo = JSON.parse(document.getElementById('json-user-info').text).data,
		userPage = JSON.parse(document.getElementById('json-user-page').text).page,
		recentAchievements = JSON.parse(document.getElementById('json-user-recent-achievements').text).data,
		achievementsCounts = JSON.parse(document.getElementById('json-user-achievements-counts').text),
		canEdit = function() { return (window.user === null ? null : userInfo.id === window.user.user_id); };

	window.ProfilePage = React.createClass({
		getInitialState: function() {
			return {
				mode: this.props.initialMode,
				user: this.props.user,
				userPage: {
					html: this.props.userPage.html,
					initialRaw: this.props.userPage.raw,
					raw: this.props.userPage.raw,
					editing: false,
				},
				isCoverUpdating: false,
			};
		},

		changeCoverDefault: function(_e, coverId) {
			$.ajax(window.changeCoverUrl, {
					method: 'PUT',
					data: { 'cover_id': coverId },
					dataType: 'json'
			})
			.done(function(userData) {
				this.updateData(null, userData.data);
			}.bind(this));
		},

		changeMode: function(e) {
			e.preventDefault();

			this.setState({ mode: e.target.getAttribute('data-mode') });
		},

		updateData: function(_e, user) {
			if (user !== undefined && user !== null) {
				this.setState({ user: user });
			}
		},

		coverUploadComplete: function() {
			this.setState({ isCoverUpdating: false });
		},

		coverUploadStart: function() {
			this.setState({ isCoverUpdating: true });
		},

		pageUpdate: function(_e, newUserPage) {
			var userPage = this.state.userPage;
			this.setState({ userPage: _.extend(userPage, newUserPage) });
		},

		unlistenAll: function() {
			$(document).off('profile:cover:select');
			$(document).off('profile:updated');
			$(document).off('profile:cover:upload:start');
			$(document).off('profile:cover:upload:complete');
			$(document).off('profile:page:update');
		},

		listenAll: function() {
			this.unlistenAll();
			$(document).on('profile:cover:select', this.changeCoverDefault);
			$(document).on('profile:updated', this.updateData);
			$(document).on('profile:cover:upload:start', this.coverUploadStart);
			$(document).on('profile:cover:upload:complete', this.coverUploadComplete);
			$(document).on('profile:page:update', this.pageUpdate);
		},

		componentDidMount: function() {
			this.listenAll();
		},

		componentWillUnmount: function() {
			this.unlistenAll();
		},

		render: function() {
			var
				stats = this.props.allStats[this.state.mode],
				headerMode,
				headerStats,
				contentsExtra;

			if (stats === undefined) {
				headerMode = this.props.initialMode;
				headerStats = this.props.allStats[headerMode].data;
			} else {
				headerMode = this.state.mode;
				stats = headerStats = stats.data;
			}

			if (this.state.mode !== 'me') {
				contentsExtra = <ProfileContentsExtra />;
			}

			return (
				<div className='flex-column flex-full flex-fullwidth'>
					<ProfileHeader
						user={this.state.user}
						stats={headerStats}
						mode={headerMode}
						withEdit={this.props.withEdit}
						isCoverUpdating={this.state.isCoverUpdating}
					/>

					<ProfileContents
						user={this.state.user}
						userPage={this.state.userPage}
						stats={stats}
						mode={this.state.mode}
						changeMode={this.changeMode}
						recentAchievements={this.props.recentAchievements}
						achievementsCounts={this.props.achievementsCounts}
						withEdit={this.props.withEdit}
					/>

					{contentsExtra}
				</div>
			);
		}
	});

	React.render(
		<ProfilePage
			user={userInfo}
			userPage={userPage}
			allStats={stats}
			initialMode={window.userPlaymode}
			withEdit={canEdit()}
			recentAchievements={recentAchievements}
			achievementsCounts={achievementsCounts}
		/>,
		document.getElementsByClassName('content')[0]
	);
}).call(this)
