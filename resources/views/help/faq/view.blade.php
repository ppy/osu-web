@extends("master")

@section('content')
<div class="osu-layout__section osu-layout__section--full">
	<div class="osu-layout__row osu-layout__row--with-gutter">
		<div class="osu-layout__row--page faq-article">
			<div class="col-sm-12 faq-article__page">
				<h2 class="faq-article__heading">
					{{ $article->title }}
				</h2>
				<div>
					<p>
						{!! Markdown::convertToHtml($article->content) !!}
					</p>
				</div>
			</div>
			<div class="faq-article__actions">
				<div class="forum-post-actions">
					<a class="forum-post-actions__action" href="/help/faq/update/{{$article->id}}">
						<i class="fa fa-pencil"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection