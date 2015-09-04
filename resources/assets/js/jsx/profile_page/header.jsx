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

	window.DefaultCover = React.createClass({
		onClick: function() {
			$(document).trigger('profile:cover:select', this.props.name);
		},

<<<<<<< HEAD
<<<<<<< HEAD
		onMouseEnter: function() {
			$(document).trigger('profile:cover:preview', "/images/headers/profile-covers/c" + this.props.name + ".jpg");
		},
		
		onMouseLeave: function() {
			if(this.props.selectedName !== null){
				var b = this.props.selectedName === this.props.name;
				if(b === false){
				$(document).trigger('profile:cover:preview', "/images/headers/profile-covers/c" + this.props.selectedName + ".jpg");
				}
			}else{
				$(document).trigger('profile:cover:previewurl');
			}
		},
=======
>>>>>>> parent of fdc8f1c... Profile Preview
=======
>>>>>>> parent of fdc8f1c... Profile Preview
		render: function() {
			var
				selectedMark;
			if (this.props.selectedName === this.props.name) {
				selectedMark = (
					<i className='fa fa-check-circle profile-cover-selection__selected-mark' />
				);
			}

			return (
				<div
					className='profile-cover-selection'
					style={{ backgroundImage: `url('/images/headers/profile-covers/c${this.props.name}t.jpg')` }}
					onClick={this.onClick}
				>
					{selectedMark}
				</div>
			);
		}
	});

	window.ProfileCoverUploader = React.createClass({
		mixins: [React.addons.PureRenderMixin],

		componentDidMount: function() {
			var $uploadButton = $('.js-profile-cover-upload');
			$uploadButton.fileupload({
				method: 'PUT',
				dataType: 'json',
				dropZone: $uploadButton,
				submit: function() {
					$(document).trigger('profile:cover:upload:start');
				},
				done: function(_e, data) {
					$(document).trigger('profile:updated', data.result.data);
				},
				fail: function(_e, data) {
					var message;
					if (data.jqXHR !== undefined && data.jqXHR.responseJSON !== undefined) {
						message = data.jqXHR.responseJSON.error;
					} else {
						message = Lang.get('errors.unknown');
					}
					osu.popup(message, 'danger');
				},
				complete: function() {
					$(document).trigger('profile:cover:upload:complete');
				}
			});
		},

		componentWillUnmount: function() {
			$('.js-profile-cover-upload').fileupload('destroy');
		},

		render: function() {
			var
				labelClass = 'btn-osu btn-osu-lite file-upload-label profile-cover-upload-button';

			if (!this.props.canUpload) {
				labelClass += ' disabled';
			}

			return (
				<div className='profile-cover-upload'>
					<label className={labelClass}>
						{Lang.get('users.show.edit.cover.upload.button')}
						<input
							className='js-profile-cover-upload file-upload-input'
							type='file'
							name='cover_file'
							data-url={window.changeCoverUrl}
							disabled={!this.props.canUpload}
						/>
					</label>
					<div className='profile-cover-upload-info'>
						<p className='profile-cover-upload-info-entry'>
							<strong dangerouslySetInnerHTML={{ __html: Lang.get('users.show.edit.cover.upload.restriction_info') }} />
						</p>
						<p className='profile-cover-upload-info-entry'>
							{Lang.get('users.show.edit.cover.upload.size_info')}
						</p>
					</div>
				</div>
			);
		}
	});

	window.ProfileCoverSelector = React.createClass({
		render: function() {
			var defaultCovers = [];
			for (var i = 1; i <= 8; i++) {
				defaultCovers.push(<DefaultCover
					key={i}
					selectedName={this.props.selectedName}
					name={i.toString()}
				/>);
			}

			return (
				<div className='profile-change-cover-popup'>
					<div className='profile-change-cover-defaults'>
						{defaultCovers}
						<p className='profile-cover-selections-info'>
							{Lang.get('users.show.edit.cover.defaults_info')}
						</p>
					</div>
					<ProfileCoverUploader canUpload={this.props.canUpload} />
				</div>
			);
		}
	});

	window.ProfileHeader = React.createClass({
		getInitialState: function() {
			return { editing: false };
		},

		toggleEdit: function() {
			if (this.state.editing) {
				this.setState({ editing: false });
				$('.blackout').css({ display: 'none' });
				$('.profile-header').css({ zIndex: '' });

				$(document).off('click.profile:toggle-header-edit');
			} else {
				this.setState({ editing: true });
				$('.blackout').css({ display: 'block' });
				$('.profile-header').css({ zIndex: 8001 });

				$(document).on('click.profile:toggle-header-edit', function(e) {
					if ($(e.target).closest('.profile-change-cover-popup').length !== 0) { return; }
					if ($(e.target).closest('.profile-change-cover-button').length !== 0) { return; }
					if ($('#overlay').is(':visible')) { return; }
					this.toggleEdit();
				}.bind(this));
			}
		},

		changeCoverButton: function() {
			if (!this.props.withEdit) { return; }

			return (
				<div className='profile-change-cover-button' onClick={this.toggleEdit}>
					{Lang.get('users.show.edit.cover.button')}
				</div>
			);
		},

		changeCoverPopup: function() {
			if (!this.state.editing) { return; }

			return <ProfileCoverSelector canUpload={this.props.user.isSupporter} selectedName={this.props.user.cover.id} />;
		},

		coverUploadSpinner: function() {
			var style;
			if (!this.props.isCoverUpdating) {
				style = { display: 'none' };
			}

			return (
				<div className='profile-cover-uploading-spinner' style={style} >
					<i className='fa fa-circle-o-notch fa-spin' />
				</div>
			);
		},

		render: function() {
			return (
				<div className='row-page profile-header'>
					<div className='profile-cover' style={{ backgroundImage: `url('${this.props.user.cover.url}')` }} />
					<div className='profile-avatar-container'>
						<div
							className='avatar avatar--profile'
							style={{ backgroundImage: `url('${this.props.user.avatarUrl}')` }}
							title={Lang.get('users.show.avatar', { username: this.props.user.username })}
						/>
					</div>
					{this.coverUploadSpinner()}
					{this.changeCoverButton()}
					{this.changeCoverPopup()}
					<div className='user-bar-container'>
						<ProfileHeaderInfo user={this.props.user} />

						<ProfileRank
							rank={this.props.stats.rank}
							country={this.props.user.country}
							mode={this.props.mode}
						/>
					</div>
				</div>
			);
		}
	});

	window.ProfileHeaderInfo = React.createClass({
		render: function() {
			return (
				<div className='user-bar'>
					<div>
						<h1 className='profile-basic--large profile-basic'>{this.props.user.username}</h1>
						<p className='profile-basic'>{this.props.user.joinDate}</p>
					</div>
				</div>
			);
		}
	});

	window.ProfileRank = React.createClass({
		render: function() {
			if (this.props.rank.isRanked === true) {
				var countryRank;
				if (this.props.country !== null) {
					countryRank = (
						<p className='profile-basic'>
							{this.props.country} #{this.props.rank.country.toLocaleString()}
						</p>
					);
				}

				return (
					<div className='user-bar user-rank'>
						<div>
							<p className='profile-basic profile-basic--large'>
								<span className='user-rank-icon'>
									<i className={`fa osu fa-${this.props.mode}-o`}></i>
								</span>

								#{this.props.rank.global.toLocaleString()}
							</p>
							{countryRank}
						</div>

					</div>
				);
			} else {
				return (
					<div></div>
				);
			}
		}
	});
}).call(this)
