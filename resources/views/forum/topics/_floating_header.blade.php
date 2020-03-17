{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

@section('sticky-header-breadcrumbs')
    @include('forum.topics._header_breadcrumb_small', [
        'forum' => $topic->forum,
    ])
@endsection()

@section('sticky-header-content')
    <h1 class="forum-topic-floating-header u-ellipsis-overflow">
        <a
            href="{{ route("forum.topics.show", $topic->topic_id) }}"
            class="forum-topic-floating-header__title-link"
        >
            {{ $topic->topic_title }}
        </a>
    </h1>
@endsection()
