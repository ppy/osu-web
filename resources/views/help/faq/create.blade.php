@extends("master")

@section('content')
<div class="osu-layout__section osu-layout__section--full">
	<div class="osu-layout__row osu-layout__row--with-gutter">
		<div class="osu-layout__row--page">
		<form action="{{ isset($article) ? route('faq.update', $article->id) : route('faq.create') }}" method="POST">
			{{ csrf_field() }}
			<div class="wide col-sm-12 faq__article--page">
				<h2 class="faq__article--heading">
					<input name="title" placeholder="article title here" value="{{$article->title or ''}}">
				</h2>
				<div class="faq__article--category-picker">
					<select name="category_id">
						@if ($categoryId != null)
							<option>Article category...</option>
						@endif
						@foreach($categories as $category)
							<option value="{{ $category->id }}" {{ $category->id == $categoryId ? "selected" : ""}}>{{ $category->title }}</option>
						@endforeach
					</select>
				</div>
				<div class="faq__article--content">
					<textarea name="content" class="faq__article--input" placeholder="article content here">{{$article->content or ''}}</textarea>
				</div>
				<div class="faq__article--controls">
					<button type="submit" class="btn-osu btn-osu-default btn-osu--small">Save</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>

@endsection