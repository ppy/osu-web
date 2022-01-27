{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<button
    class="btn-circle btn-circle--topic-nav btn-circle--yellow"
    data-target="#forum-topic-move-modal"
    data-toggle="modal"
    type="button"
    title="{{ osu_trans('forum.topics.moderate_move.title') }}"
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
                            {{ osu_trans('forum.topics.moderate_move.title') }}
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
                            <button class="btn-osu-big btn-osu-big--forum-primary">{{ osu_trans('common.buttons.save') }}</button>
                        </p>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
