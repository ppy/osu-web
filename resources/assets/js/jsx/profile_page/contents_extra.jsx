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

	window.ProfileContentsExtra = React.createClass({
		componentDidMount: function() {
			this.componentWillReceiveProps();
		},

		componentWillReceiveProps: function() {
			setTimeout(function() {
				$(document).trigger('osu:page:change');
			}, 0);
		},

		render: function() {
			var profileDetail;
			if (this.props.mode === 'me') {
				return;
			}

			return (
				<div className='content content-extra flex-full'>
					<ul className='profile-extra-tabs'>
						<li className='profile-extra-tab'>{Lang.get('users.show.extra.top_ranks')}</li>
						<li className='profile-extra-tab'>{Lang.get('users.show.extra.recent_activities')}</li>
						<li className='profile-extra-tab'>{Lang.get('users.show.extra.historical')}</li>
						<li className='profile-extra-tab'>{Lang.get('users.show.extra.beatmaps')}</li>
						<li className='profile-extra-tab'>{Lang.get('users.show.extra.kudosu')}</li>
						<li className='profile-extra-tab'>{Lang.get('users.show.extra.achievements')}</li>
					</ul>
					<div className='row-page'>
						Here be extra contents.
					</div>
				</div>
			);
		}
	});
}).call(this)
