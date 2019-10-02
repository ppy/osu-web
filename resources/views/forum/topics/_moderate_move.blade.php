{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
<button
    class="btn-circle btn-circle--topic-nav btn-circle--yellow"
    data-target="#forum-topic-move-modal"
    data-toggle="modal"
    type="button"
    title="{{ trans('forum.topics.moderate_move.title') }}"
>
    <span class="btn-circle__content">
        <i class="fas fa-arrows-alt"></i>
    </span>
</button>

@section('script')
    @parent

    <div id="forum-topic-move-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog@sm">
            <div class="modal-content">
                <div class="modal-body modal-body--page">
                    {!! Form::open(['url' => route('forum.topics.move', $topic->topic_id), 'data-remote' => true]) !!}
                        <h1 class="modal-body__title">
                            {{ trans('forum.topics.moderate_move.title') }}
                        </h1>

                        <p>
                            <label class="form-select">
                                <select name="destination_forum_id" class="form-select__input">
                                    @foreach (App\Models\Forum\Forum::displayList()->get() as $dstForum)
                                        <option value="{{ $dstForum->getKey() }}"
                                            {{ $dstForum->isOpen() ? '' : 'disabled' }}
                                            {{ $dstForum->getKey() === $topic->forum_id ? 'selected' : '' }}
                                        >
                                            {{ str_repeat('–', $dstForum->currentDepth()) }}
                                            {{ $dstForum->forum_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                        </p>

                        <p class="text-right">
                            <button class="btn-osu-big btn-osu-big--forum-primary">{{ trans('common.buttons.save') }}</button>
                        </p>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
