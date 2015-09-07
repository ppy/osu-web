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

	window.ProfileContents = React.createClass({
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
				profileDetail = <ProfileUserPage withEdit={this.props.withEdit} userPage={this.props.userPage} user={this.props.user} />;
			}
			else {
				profileDetail = [
					<ProfileStats key='stats' stats={this.props.stats} />,
					<ProfileRecentAchievements
						key='recent-achievements'
						achievementsCounts={this.props.achievementsCounts}
						recentAchievements={this.props.recentAchievements}
					/>,
				];
			}

			var tabs = [['osu', 'osu!'], ['taiko', 'osu!taiko'], ['ctb', 'osu!ctb'], ['mania', 'osu!mania']];
			if (this.props.userPage.html !== '' || this.props.withEdit) {
				tabs.unshift(['me', 'me!']);
			}

			var mainClass = 'row-page row-page--profile flex-column';
			if (this.props.mode === 'me') {
				mainClass += ' flex-full';
			}

			return (
				<div className={mainClass}>
					<div className='profile-tabs'>
						{tabs.map(function(m) {
							return (
								<ProfileTab
									key={m[0]}
									currentMode={this.props.mode}
									changeMode={this.props.changeMode}
									mode={m[0]} text={m[1]}
								/>
							);
						}, this)}
					</div>

					<div className='profile-contents flex-full flex-row'>
						<ProfileInfo user={this.props.user} />
						{profileDetail}
					</div>
				</div>
			);
		}
	});

	window.ProfileInfo = React.createClass({
		componentDidMount: function() {
			osu.initTimeago()
		},

		componentDidUpdate: function() {
			osu.initTimeago()
		},

		_supporter: function() {
			if (!this.props.user.isSupporter) { return; }
			return (
				<p className="profile-title profile-title--supporter">
					{Lang.get('users.show.is_supporter')}
				</p>
			);
		},

		_supporterIcon: function() {
			if (!this.props.user.isSupporter) { return; }
			return (
				<div className='user-icon forum__user-icon--supporter profile-icon' title={Lang.get('users.show.is_supporter')}>
					<i className='fa fa-heart'></i>
				</div>
			);
		},

		_title: function() {
			if (this.props.user.title === null) { return; }
			return <p className='profile-title'>{this.props.user.title}</p>;
		},

		_origin: function() {
			var originKeys = [];
			if (this.props.user.country !== null) { originKeys.push('country'); }
			if (this.props.user.age !== null) { originKeys.push('age'); }

			if (originKeys.length === 0) { return; }
			return (
				<p>
					{Lang.get(`users.show.origin.${originKeys.join('_')}`, {
						country: this.props.user.country,
						age: this.props.user.age
					})}
				</p>
			);
		},

		_currentLocation: function() {
			if (this.props.user.location === null) { return; }
			return <p>{Lang.get('users.show.current_location', { location: this.props.user.location })}</p>;
		},

		_twitter: function() {
			if (this.props.user.twitter === null) { return; }
			return (
				<dl className='profile-data profile-row'>
					<dt>Twitter</dt>
					<dd><a href={`https://twitter.com/${this.props.user.twitter}`}>{`@${this.props.user.twitter}`}</a></dd>
				</dl>
			);
		},

		_skype: function() {
			if (this.props.user.skype === null) { return; }
			return (
				<dl className='profile-data profile-row'>
					<dt>Skype</dt>
					<dd><a href={`skype:${this.props.user.skype}?chat`}>{this.props.user.skype}</a></dd>
				</dl>
			);
		},

		_lastfm: function() {
			if (this.props.user.lastfm === null) { return; }
			return (
				<dl className='profile-data profile-row'>
					<dt>Last.fm</dt>
					<dd><a href={`https://last.fm/user/${this.props.user.lastfm}`}>{this.props.user.lastfm}</a></dd>
				</dl>
			);
		},

		_playsWith: function() {
			if (this.props.user.playstyle.length === 0) { return; }
			return (
				<dl className='profile-data profile-row'>
					<dt>{Lang.get('users.show.plays_with._')}</dt>
					<dd>
						{
							this.props.user.playstyle.map(function(s) {
								return Lang.get(`users.show.plays_with.${s}`);
							}).join(', ')
						}
					</dd>
				</dl>
			);
		},

		render: function() {
			return (
				<div className='profile-content flex-col-33'>
					<div className='profile-icons profile-row'>
						{this._supporterIcon()}
					</div>

					<div className='compact profile-row'>
						{this._supporter()}
						{this._title()}
					</div>

					<div className='compact profile-row'>
						{this._origin()}
						{this._currentLocation()}
					</div>

					<p className='profile-row' dangerouslySetInnerHTML={{ __html: Lang.get('users.show.lastvisit', {
							date:
								React.renderToStaticMarkup(
									<time className='timeago-raw timeago' dateTime={this.props.user.lastvisit}>
										{this.props.user.lastvisit}
									</time>
								)
					})}} />

					{this._twitter()}
					{this._skype()}
					{this._lastfm()}
					{this._playsWith()}
				</div>
			);
		}
	})

	window.ProfileStats = React.createClass({
		render: function() {
			return (
				<div className='profile-content flex-col-33'>
					<div className='profile-row profile-row--top'>
						<div className='profile-top-badge profile-level-badge'>
							<span className='profile-badge-number'>{this.props.stats.level.current}</span>
						</div>

						<div className='profile-exp-bar'>
							<div className='profile-exp-bar-fill' style={{ width: `${this.props.stats.level.progress.toFixed()}%` }}>
							</div>
						</div>
						<dl className='profile-stats profile-stats--light'>
							<dt>{Lang.get('users.show.stats.level', { level: this.props.stats.level.current })}</dt>
							<dd>{this.props.stats.level.progress.toFixed()}%</dd>
						</dl>
					</div>

					<div className='profile-row'>
						<dl className='profile-stats'>
							<dt>{Lang.get('users.show.stats.ranked_score')}</dt>
							<dd>{this.props.stats.rankedScore.toLocaleString()}</dd>
						</dl>

						<dl className='profile-stats'>
							<dt>{Lang.get('users.show.stats.hit_accuracy')}</dt>
							<dd>{this.props.stats.hitAccuracy.toFixed(2)}%</dd>
						</dl>

						<dl className='profile-stats'>
							<dt>{Lang.get('users.show.stats.play_count')}</dt>
							<dd>{this.props.stats.playCount.toLocaleString()}</dd>
						</dl>

						<dl className='profile-stats'>
							<dt>{Lang.get('users.show.stats.total_score')}</dt>
							<dd>{this.props.stats.totalScore.toLocaleString()}</dd>
						</dl>

						<dl className='profile-stats'>
							<dt>{Lang.get('users.show.stats.total_hits')}</dt>
							<dd>{this.props.stats.totalHits.toLocaleString()}</dd>
						</dl>

						<dl className='profile-stats'>
							<dt>{Lang.get('users.show.stats.maximum_combo')}</dt>
							<dd>{this.props.stats.maximumCombo.toLocaleString()}</dd>
						</dl>

						<dl className='profile-stats'>
							<dt>{Lang.get('users.show.stats.replays_watched_by_others')}</dt>
							<dd>{this.props.stats.replaysWatchedByOthers.toLocaleString()}</dd>
						</dl>

						<dl className='profile-stats profile-stats--full'>
							<dt>{Lang.get('users.show.stats.score_ranks')}</dt>
							<dd className='profile-score-ranks'>
								{['ss', 's', 'a'].map(function(x) {
									return (
										<div key={`rank-${x}`} className='profile-score-rank'>
											<div className={`profile-score-rank-badge profile-score-rank-badge--${x}`} />
											<div>
												{this.props.stats.scoreRanks[x]}
											</div>
										</div>
									);
								}, this)}
							</dd>
						</dl>

					</div>
				</div>
			);
		}
	});

	window.ProfileAchievementBadge = React.createClass({
		render: function() {
			var
				filename = `/images/badges/user-achievements/${this.props.achievement.slug}.png`,
				filename2x = `/images/badges/user-achievements/${this.props.achievement.slug}@2x.png`;

			return (
				<div className={`profile-achievement-badge ${this.props.additionalClasses}`}>
					<img
						src={filename}
						srcSet={`${filename} 1x, ${filename2x} 2x`}
						alt={this.props.achievement.name}
						title={this.props.achievement.name}
					/>
				</div>
			);
		}
	});

	window.ProfileRecentAchievements = React.createClass({
		_andMore: function() {
			var moreCount = this.props.achievementsCounts.user - this.props.recentAchievements.length;

			if (moreCount <= 0) { return; }
			return (
				<small>{Lang.get("users.show.more_achievements", { count: moreCount })}</small>
			);
		},

		render: function() {
			var achievementsProgress = (100 * this.props.achievementsCounts.user / this.props.achievementsCounts.total).toFixed();

			return (
				<div className="profile-content flex-col-33 text-center">
					<div className="profile-row profile-row--top">
						<div className="profile-achievements-badge profile-top-badge">
							<span className="profile-badge-number">{this.props.achievementsCounts.user}</span>
						</div>

						<div className="profile-exp-bar">
							<div className="profile-exp-bar-fill" style={{ width: `${achievementsProgress}%` }} />
						</div>

						<dl className="profile-stats profile-stats--light">
							<dt />
							<dd>{achievementsProgress}%</dd>
						</dl>
					</div>
					<div className="profile-row profile-recent-achievements">
						{this.props.recentAchievements.map(function(achievement) {
							return (
								<ProfileAchievementBadge
									key={`profile-achievement-${achievement.achievement_id}`}
									achievement={achievement}
									additionalClasses="profile-recent-achievement-badge"
								/>
							);
						}, this)}
					</div>
					{this._andMore()}
				</div>
			);
		}
	});

	window.ProfileTab = React.createClass({
		tabClassName: function() {
			var className = 'profile-tab';

			if (this.props.mode === this.props.currentMode) {
				className += ' profile-tab--active';
			}

			return className;
		},

		render: function() {
			return (
				<a href='#' data-mode={this.props.mode} onClick={this.props.changeMode} className={this.tabClassName()}>{this.props.text}</a>
			);
		}
	});

	window.ProfileUserPage = React.createClass({
		editLink: function() {
			if (!this.props.withEdit) { return; }
			return (
				<div className='profile-user-page-header text-right'>
					<a href='#' onClick={this.editStart}>
						<i className='fa fa-edit' />
					</a>
				</div>
			);
		},

		editStart: function(e) {
			e.preventDefault();
			$(document).trigger('profile:page:update', { editing: true });
		},

		pageNew: function() {
			var canCreate = this.props.withEdit && this.props.user.isSupporter;
			return (
				<div
					className='profile-content flex-col-66 text-center'
				>
					<button className='profile-page-new-content btn-osu btn-osu-lite btn-osu-lite--plain btn-osu-lite--profile-page-edit' onClick={this.editStart} disabled={!canCreate}>
						{Lang.get('users.show.page.edit_big')}
					</button>

					<p className='profile-page-new-content profile-page-new-icon'>
						<i className='fa fa-pencil-square-o' />
					</p>

					<p
						className='profile-page-new-content'
						dangerouslySetInnerHTML={{ __html: Lang.get('users.show.page.description') }}
					/>

					<p
						className='profile-page-new-content'
						dangerouslySetInnerHTML={{ __html: Lang.get('users.show.page.restriction_info') }}
					/>
				</div>
			);
		},

		pageShow: function() {
			return (
				<div className='profile-content flex-col-66'>
					{this.editLink()}
					<div dangerouslySetInnerHTML={{ __html: this.props.userPage.html }} />
				</div>
			);
		},

		render: function() {
			if (!this.props.withEdit) {
				return this.pageShow();
			}

			if (this.props.userPage.editing) {
				return <ProfileUserPageEditor userPage={this.props.userPage} />
			} else if (this.props.userPage.html === '') {
				return this.pageNew();
			} else {
				return this.pageShow();
			}
		}
	});


	window.ProfileUserPageEditor = React.createClass({
		_body: function() {
			return React.findDOMNode(this.refs.body);
		},

		getInitialState: function() {
			return {
				raw: this.props.userPage.raw,
			};
		},

		componentDidMount: function() {
			var body = this._body();
			$(body).on('change', this.change);

			body.selectionStart = this.props.userPage.selection[0];
			body.selectionEnd = this.props.userPage.selection[1];
			this.focus();
		},

		componentWillUnmount: function() {
			var body = this._body();
			$(body).off('change', this.change);

			$(document).trigger('profile:page:update', {
				raw: this.state.raw,
				selection: [body.selectionStart, body.selectionEnd],
			});
		},

		focus: function() {
			this._body().focus();
		},

		reset: function(_e, callback) {
			if (typeof callback !== 'function') {
				callback = this.focus;
			}
			this.setState({ raw: this.props.userPage.initialRaw }, callback);
		},

		cancel: function() {
			this.reset(null, function() {
				$(document).trigger('profile:page:update', { editing: false });
			});
		},

		save: function(e) {
			var body = this.state.raw;
			osu.showLoadingOverlay();
			$.ajax(
				window.changePageUrl,
				{
					method: 'PUT',
					dataType: 'json',
					data: { body: body }
				}
			).done(function(data) {
				$(document).trigger('profile:page:update', {
					html: data.html,
					editing: false,
					raw: body,
					initialRaw: body,
				});
			}.bind(this))
			.always(function() {
				osu.hideLoadingOverlay();
			});
		},

		change: function(e) {
			this.setState({ raw: e.target.value });
		},

		render: function() {
			return (
				<form className='profile-content flex-col-66 profile-page-editor flex-column'>
					<textarea
						className='flex-full profile-page-editor-body'
						name='body'
						value={this.state.raw}
						onChange={this.change}
						placeholder={Lang.get('users.show.page.placeholder')}
						ref='body'
					/>

					<div className='post-editor__footer post-editor__footer--profile-page'>
						<div dangerouslySetInnerHTML={{ __html: osu.parseJson('json-post-editor-toolbar').html }} />
						<div className='profile-page-editor__actions'>
							<button className='btn-osu btn-osu-lite profile-page-editor-button' type='button' onClick={this.cancel}>
								{Lang.get('common.buttons.cancel')}
							</button>
							<button className='btn-osu btn-osu-lite profile-page-editor-button' type='button' onClick={this.reset}>
								{Lang.get('common.buttons.reset')}
							</button>
							<button className='btn-osu btn-osu-lite profile-page-editor-button' type='button' onClick={this.save}>
								{Lang.get('common.buttons.save')}
							</button>
						</div>
					</div>
				</form>
			)
		},
	});
}).call(this)
