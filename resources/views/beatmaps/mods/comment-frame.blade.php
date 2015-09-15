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
<div class="row">
    <div class="tab-content" style="padding-right: 25px">
        <div class="pull-right" style="padding-bottom: 10px">
            <a href='#tab-praise' class='blue-dark n' data-toggle="tab"><i class='fa fa-heart'></i> {{{ Lang::choice("beatmaps.modding.feedback.praise", 1) }}}</a>
            / <a href='#tab-suggestion' class='yellow-darker n' data-toggle="tab"><i class='fa fa-circle-o'></i> {{{ Lang::choice("beatmaps.modding.feedback.suggestion", 1) }}}</a>
            / <a href='#tab-problem' class='text-primary n' data-toggle="tab"><i class='fa fa-exclamation-circle'></i> {{{ Lang::choice("beatmaps.modding.feedback.problem", 1) }}}</a>
            @if (Auth::check() and Auth::user()->isBAT())
                / <a href='#tab-nomination' class='green-dark n' data-toggle="tab"><i class='fa fa-plus-square'></i> {{{ Lang::choice("beatmaps.modding.feedback.nominate", 1) }}}</a>
            @endif
        </div>
        <div class="tab-content tab-pane active" id="tab-praise">
            {!! Form::open(["url" => "/api/mod-comment/{$set->beatmapset_id}", "data-handler" => "moddingHandler"]) !!}
                <input type="hidden" class="beatmap-choice" name="beatmap" value="general">
                <input type="hidden" name="type" value="praise">
                <div class="form-group">
                    <textarea class="form-control" rows="4" name="comment" placeholder="{{{ trans("beatmaps.modding.comments.comment") }}}"></textarea>
                </div>
                <div class="form-group">
                    <input type="text" name="time" class="form-control" placeholder="{{{ trans("beatmaps.modding.comments.time") }}}">
                    <p class="help-block small">
                        {{{ trans("beatmaps.modding.helptext.time") }}}
                    </p>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Post</button>
                </div>
            {!! Form::close() !!}
        </div>

        <div class="tab-content tab-pane" id="tab-suggestion">
            {!! Form::open(["url" => "/api/mod-comment/{$set->beatmapset_id}", "data-handler" => "moddingHandler"]) !!}
                <input type="hidden" class="beatmap-choice" name="beatmap" value="general">
                <input type="hidden" name="type" value="suggestion">
                <div class="form-group">
                    <textarea class="form-control" rows="4" name="comment" placeholder="{{{ trans("beatmaps.modding.comments.comment") }}}"></textarea>
                </div>
                <div class="form-group">
                    <input type="text" name="time" class="form-control" placeholder="{{{ trans("beatmaps.modding.comments.time") }}}">
                    <p class="help-block small">
                        {{{ trans("beatmaps.modding.helptext.time") }}}
                    </p>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-warning">Post</button>
                </div>
            {!! Form::close() !!}
        </div>
        <div class="tab-content tab-pane" id="tab-problem">
            {!! Form::open(["url" => "/api/mod-comment/{$set->beatmapset_id}", "data-handler" => "moddingHandler"]) !!}
                <input type="hidden" class="beatmap-choice" name="beatmap" value="general">
                <input type="hidden" name="type" value="problem">
                <div class="form-group">
                    <textarea class="form-control" rows="4" name="comment" placeholder="{{{ trans("beatmaps.modding.comments.comment") }}}"></textarea>
                </div>

                <div class="form-group">
                    <input type="text" name="time" class="form-control" placeholder="{{{ trans("beatmaps.modding.comments.time") }}}">
                    <p class="help-block small">
                        {{{ trans("beatmaps.modding.helptext.time") }}}
                    </p>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>
            {!! Form::close() !!}
        </div>

        @if (Auth::check() and Auth::user()->isBAT())
            <div class="tab-content tab-pane" id="tab-nomination">
                {!! Form::open(["url" => "/api/mod-comment/{$set->beatmapset_id}", "data-handler" => "moddingHandler"]) !!}
                    <input type="hidden" name="type" value="nomination">
                    <input type="hidden" name="beatmap" value="general">
                    <div class="form-group">
                        <textarea class="form-control" rows="4" name="comment" placeholder="{{{ trans("beatmaps.modding.comments.comment") }}}"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="confirm" value="1"> {{{ trans("beatmaps.modding.helptext.confirm") }}}
                            </label>
                        </div>
                    </div>
                    <p class="help-block small">
                        {!! trans("beatmaps.modding.helptext.nominate", ["ranking" => "<a href=\"/help/faq#ranking\">" . trans("beatmaps.modding.helptext.ranking") . "</a>"]) !!}
                    </p>
                    <p class="help-block small">
                        {{{ trans("beatmaps.modding.helptext.warning") }}}
                    </p>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">{{{ Lang::choice("beatmaps.modding.feedback.nominate", 1) }}}</button>
                    </div>
                {!! Form::close() !!}
            </div>
        @endif

    </div>
</div>
