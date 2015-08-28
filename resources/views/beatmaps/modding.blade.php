{{--
    Copyright 2015 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
@extends("master")

@section("content")
	<div class="row">
		<div class="col-md-6">
			<h4><a href='/beatmaps/modding'>Modding Portal</a> &raquo; Beatmap Discussion</h4>
			<h3>{{{ $set->title }}}</h3>
			<h4 class="text-muted">{{{ $set->artist }}}</h4>
			<style>
				.score-selector {
					cursor: pointer;
				}
				.score-selector:hover {
					color: rgb(238, 51, 153) !important;
				}
				.unranked {
					color: rgb(219, 219, 219);
				}
				.unranked:hover {
					color: rgb(128, 128, 128) !important;
				}
				.grey {
					color: rgb(128, 128, 128) !important;
				}
			</style>
			@if (true)
				<i data-target="osu" class="score-selector fa fa-2x fa-osu-o osu"></i>
			@else
				<i data-target="osu" class="score-selector unranked fa fa-3x fa-osu-o osu"></i>
			@endif

			@if (true)
				<i data-target="taiko" class="score-selector fa fa-2x fa-taiko-o osu"></i>
			@else
				<i data-target="taiko" class="score-selector unranked fa fa-3x fa-taiko-o osu"></i>
			@endif

			@if (true)
				<i data-target="ctb" class="score-selector fa fa-2x fa-ctb-o osu"></i>
			@else
				<i data-target="ctb" class="score-selector unranked fa fa-3x fa-ctb-o osu"></i>
			@endif

			@if (true)
				<i data-target="mania" class="score-selector fa fa-2x fa-mania-o osu"></i>
			@else
				<i data-target="mania" class="score-selector unranked fa fa-3x fa-mania-o osu"></i>
			@endif

		</div>
		<div class="col-md-6">
			<div class="col-xs-12" style="padding: 0 0 15px 0;">
				@include("objects.beatmap-panel", ["beatmap" => $set])
			</div>
			<div class="row">
				<div class="col-xs-3"></div>
				<div class="col-xs-3">
					<div class='counter resolved'>
						<div class='title'>Resolved</div>
						<div class='number' id="totals-resolved">0</div>
					</div>
				</div>

				<div class="col-xs-3">
					<div class='counter pending'>
						<div class='title'>Pending</div>
						<div class='number' id="totals-pending">0</div>
					</div>
				</div>

				<div class="col-xs-3">
					<div class='counter'>
						<div class='title'>Total</div>
						<div class='number' id="total">0</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xs-12">
			<div class='scrubbar'></div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="selector large global-selectors">
					<a href="#filter/general" class='active n general-selector'>General Feedback</a>
					<a href="#filter/first" class="n diff-selector">Difficulty Specific</a>
					<a href="#filter/nominations" class="n nominations-selector">Nominations</a>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class='selector diffs'>
					@foreach($set->beatmaps as $map)
						<a href="#filter/{{ $map->beatmap_id }}" class="n">{{{ $map->version }}}</a>
					@endforeach
				</div>
			</div>
		</div>


		@include("beatmaps.mods.comments", ["set" => $set])
	</div>
@stop

@section("script")

	<script>
	var pending = function() {

		window.set = {{ $set->beatmapset_id or 0 }};
		window.user = {{ Auth::check() ? Auth::user()->user_id : 0 }};
		window.csrf = "{{ csrf_token() }}";
		window.clickTarget = "general";

		var child = $('<div class="child col-xs-12">' +
			'<div class="col-xs-2 child-avatar">' +
				'<a href="/u/{creator.id}" data-replace="creator.id" data-target="href">' +
					'<img class="img-rounded" data-src="//s.ppy.sh/a/{creator.id}" data-replace="creator.id" data-target="src?" width="42" height="42">' +
				'</a>' +
			'</div>' +
			'<div class="col-xs-10 comment-text">' +
				'<p class="{type}" data-replace="type" data-target="class">' +
					'<span data-content="text"></span>' +
				'</p>' +
				'<small>' +
					'<span data-text="creator.username"></span>, ' +
					'<span data-content="timeago"></span>' +
				'</small>' +
			'</div>' +
		'</div>');

		var parent = $('<div class="comment row" data-attributes="unixtime,type,id,resolved,beatmap" style="display: block;">' +
			'<div class="col-xs-2" style="padding-right: 0">' +
				'<a href="/u/{creator.id}" data-replace="creator.id" data-target="href">' +
					'<img class="img-rounded" data-src="//s.ppy.sh/a/{creator.id}" data-replace="creator.id" data-target="src?" width="50" height="50">' +
				'</a>' +
				'<p class="comment-icon" data-replace="type" data-target="class">' +
					'<i class="fa {icon} fa-lg fa-fw" data-replace="icon" data-target="class"></i>' +
				'</p>' +
				'<p style="margin-left: -2px; margin-top: 3px">' +
					'<a href="#upvote/{id}" data-replace="id" data-target="href" class="n">' +
						'<i class="fa fa-lg fa-fw fa-plus-square"></i>' +
					'</a>' +
					'<a href="#downvote/{id}" data-replace="id" data-target="href" class="n">' +
					   '<i class="fa fa-lg fa-fw fa-minus-square"></i>' +
					'</a>' +
				'</p>' +
			'</div>' +

			// content
			'<div class="col-xs-10 comment-text">' +


				// parent
				'<div class="parent col-xs-12">' +
					'<p class="comment-text-container {type}" data-replace="type" data-target="class">' +
						'<span data-content="time"></span> <span data-content="text"></span>' +
					'</p>' +
					'<small>' +
						'<span data-text="creator.username"></span>, ' +
						'<span data-content="timeago"></span>' +
					'</small>' +
				'</div>' +

				// children
				'<div class="children"></div>' +

				// replies
				'<div class="child col-xs-12 reply-box" data-if-not="resolved">' +
				   ' <div class="col-xs-2 child-avatar">' +
						'<a href="/u/{user}" data-replace="global:user" data-target="href">' +
							'<img class="img-rounded" data-src="//s.ppy.sh/a/{user}" data-replace="global:user" data-target="src?" width="42" height="42">' +
						'</a>' +
					'</div>' +
					@if (Auth::check())
						'<div class="col-xs-10 comment-text">' +
							'<form action="/api/mod-reply/{set}" data-replace="object:set" data-target="action" accept-charset="UTF-8" data-handler="moddingHandler">' +
								'<input type="hidden" name="parent" value="{id}" data-replace="id" data-target="value">' +
								'<div class="form-group">' +
									'<textarea rows="2" class="form-control" name="comment" placeholder="{{{ trans("beatmaps.modding.comments.reply") }}}"></textarea>' +
									'<span class="help-block text-center">' +

									@if (Auth::user()->isBAT() or Auth::user()->ownsSet($set))
										'<button data-if="reply" type="submit" class="btn btn-xs btn-link" name="reply-type" value="fix"><i class="fa fa-check-circle-o"></i> Reply &amp; Resolve</button>' +
									@endif
										'<button type="submit" class="btn btn-xs btn-link" name="reply-type" value="reply"><i class="fa fa-reply"></i> Reply</button>' +
									'</span>' +
								'</div>' +
							'</form>' +
						'</div>' +
					@endif
				'</div>' +
			'</div>' +
		'</div>');

		handlerCallback = function (data, id) {
			osu.handlers();
			$("[href='#filter/" + window.clickTarget + "'").click();
		}

		totalsCallback = function (data, id) {

			// increase total mods on the page automagically
			$("#total").text(parseInt($("#total").text()) + 1);
			var resolved = parseInt($("#" + id).attr("data-resolved"));

			// update the counter at the top of the page
			if (resolved) {
				$("#totals-resolved").text(parseInt($("#totals-resolved").text()) + 1);
				$("#session-resolved").text(parseInt($("#session-resolved").text()) + 1);
			} else {
				$("#totals-pending").text(parseInt($("#totals-pending").text()) + 1);
				$("#session-pending").text(parseInt($("#session-pending").text()) + 1);
			}

		};



		statsCallback = function (id, scope) {
			var author = scope.creator.id;
			var username = scope.creator.username;
			var resolved = scope.resolved;
			var $row = $('<tr class="user-stats"></tr>');
			var $rowInner = $(
				'<td class="text-right">' +
					'<span class="green-dark"><i class="fa fa-check-circle-o"></i> <span class="stat-counter">0</span></span> ' +
					'<span class="pink-darker"><i class="fa fa-times-circle-o"></i> <span class="stat-counter">0</span></span></td>');


			var $userStats = $(".user-stats[data-author='" + author + "']");

			if ($userStats.length == 0) {
					// generate the table row

					var $new = $row.clone();
					var $newRow = $rowInner.clone();

					$new.attr("data-author", author);

					$("<td></td>").text(username).appendTo($new);
					$newRow.appendTo($new);
					$new.appendTo("#stats-table > tbody");

					$userStats = $(".user-stats[data-author='" + author + "']");



			}

			var stats = $userStats.find("span.stat-counter");

			// 0 = resolved, 1 = pending
			if (resolved) {
					$(stats[0]).text(parseInt($(stats[0]).text()) + 1);
			} else {
					$(stats[1]).text(parseInt($(stats[1]).text()) + 1);
			}
		};

		window.live = new Live($("#comments").attr("data-uri"), {
			child: child,
			parent: parent,
			token: window.csrf,
			callbacks: {
				afterFetch: handlerCallback,
				afterParentCreate: totalsCallback

			},
			live: true
		});

		live.start();

		window.moddingHandler = function (data) {
			if (data.error) {
				osu.popup(data.error, "warning");
				return;
			}

			if (data.success) {
				osu.popup(data.success, "success");
				$("textarea.form-control").val('');
				live.start();
			}
			console.log(data);
		}
	};
	</script>
@stop
