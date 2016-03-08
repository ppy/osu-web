@extends("master")

@section('content')
<div class="osu-layout__section osu-layout__section--full">
	<div class="osu-layout__row osu-layout__row--with-gutter">
		<div class="osu-layout__row--page">
			<form action="{{ isset($article) ? route('faq.update', $article->id) : route('faq.create') }}" method="POST">
				{{ csrf_field() }}
				<div class="col-sm-12 faq-creation">
					<h2 class="faq-creation__heading">
						<input class="faq-creation__heading-input" name="title" placeholder="article title here" value="{{$article->title or ''}}">
					</h2>
					<div class="faq-creation__picker-container">
						<select class="faq-creation__picker-select" name="category_id">
							@if ($categoryId != null)
								<option>Article category...</option>
							@endif
							@foreach($categories as $category)
								<option value="{{ $category->id }}" {{ $category->id == $categoryId ? "selected" : ""}}>{{ $category->title }}</option>
							@endforeach
						</select>
					</div>
					<div>
						<textarea name="content" class="faq-creation__input" placeholder="article content here">{{$article->content or ''}}</textarea>
					</div>
					<div class="faq-creation__controls">
						<button type="submit" class="btn-osu-default btn-osu btn-osu--small">Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection