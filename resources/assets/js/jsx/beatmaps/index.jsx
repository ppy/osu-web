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

	require('./search_panel.jsx');
	require('./panel.jsx');
	require('./pagination.jsx');

	window.BeatmapsListing = React.createClass({
		render: function() {
			var beatmaps = [];
			for (var i = 0; i < this.props.beatmaps.length; i++) {
				beatmaps.push(<Panel beatmap={this.props.beatmaps[i]} />);
			}
			return (
				<div className={"beatmap-container " + (this.props.loading ? "dimmed" : "")}>
					<div className='sorting'>
						<a href='#'>title</a>
						<a href='#'>artist</a>
						<a href='#'>creator</a>
						<a href='#'>difficulty</a>
						<a href='#'>ranked</a>
						<a href='#' className='active'>rating</a>
						<a href='#'>plays</a>
					</div>
					<div className='view_mode'>
					</div>
					<div className='listing'>
						{beatmaps}
					</div>
				</div>
			);
		}
	});

	window.Beatmaps = React.createClass({
		getInitialState: function() {
			return {
				beatmaps: JSON.parse(document.getElementById('json-beatmaps').text)['data'],
				paging: {
					page: 1,
					url: "/beatmaps/search",
					loading: false,
					more: true
				},
				filters: {
					mode: 0,
					status: 0,
					genre: null,
					language: null,
					extra: null,
					rank: null
				},
				loading: false
			};
		},
		search: function() {
			var searchText = $('#searchbox').val();
			// if (searchText == "" || searchText == null)
			//   return;

			this.showLoader();
			$.ajax(this.state.paging.url, {
				method: 'get',
				dataType: 'json',
				data: {
					'q': searchText,
					'm': this.state.filters.mode,
					's': this.state.filters.status,
					'g': this.state.filters.genre,
					'l': this.state.filters.language,
					'e': this.state.filters.extra,
					'r': this.state.filters.rank
				}
			}).done(function(data) {
				this.setState({
					beatmaps: data['data'],
					paging: {
						page: 1,
						url: this.state.paging.url,
						loading: false,
						more: true
					},
					loading: false
				});
				$(document).trigger('beatmap:search:done');
			}.bind(this));
		},
		loadMore: function() {
			if (this.state.loading || this.state.paging.loading || !this.state.paging.more)
				return;

			$.ajax(this.state.paging.url, {
				method: 'get',
				dataType: 'json',
				data: {'q': $('#searchbox').val(), 'page': this.state.paging.page + 1}
			}).done(function(data) {
				if (data['data'].length > 0) {
					this.setState({
						beatmaps: this.state.beatmaps.concat(data['data']),
						paging: {
							page: this.state.paging.page + 1,
							url: this.state.paging.url,
							more: true
						},
						loading: false
					});
				} else {
					this.setState({
						beatmaps: this.state.beatmaps,
						paging: {
							page: this.state.paging.page,
							url: this.state.paging.url,
							more: false
						},
						loading: false
					});
				}
			}.bind(this));
		},
		showLoader: function() {
			this.setState({loading: true});
			$('#loading-area').show();
		},
		hideLoader: function() {
			this.setState({loading: false});
			$('#loading-area').hide();
		},
		updateFilters: function(lets_ignore_this, b) {
			var newFilters = $.extend({}, this.state.filters); // clone object
			newFilters[b.name] = b.value;

			if (this.state.filters != newFilters) {
				this.setState({filters: newFilters}, function() {
					$(document).trigger('beatmap:search:start');
				});
			}
		},
		componentDidMount: function() {
			$(document).on('beatmap:load_more', this.loadMore);
			$(document).on('ready page:load osu:page:change', function() { setTimeout(this.onScroll, 1000); });
			$(document).on('beatmap:search:start', this.search);
			$(document).on('beatmap:search:done', this.hideLoader);
			$(document).on('beatmap:search:filtered', this.updateFilters);
		},
		componentWillUnmount: function() {
			$(document).off('beatmap:load_more');
			$(document).off('beatmap:search:start');
			$(document).off('beatmap:search:done');
			$(document).off('beatmap:search:filtered');
		},
		render: function() {
			var searchBackground;

			if (this.state.beatmaps.length > 0)
				searchBackground = "//b.ppy.sh/thumb/" + this.state.beatmaps[0].beatmapset_id + "l.jpg";
			else
				searchBackground = "";

			return(
				<div>
					<SearchPanel background={searchBackground} />
					<div id='beatmaps' class='beatmaps padding'>
						<BeatmapsListing beatmaps={this.state.beatmaps} loading={this.state.loading} />
						<Paginator paging={this.state.paging} />
					</div>
				</div>
			);
		}
	});

	React.render(
		<Beatmaps />,
		document.getElementsByClassName('content')[0]
	);
}).call(this)
