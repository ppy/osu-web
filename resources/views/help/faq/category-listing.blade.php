@extends("master")

@section('content')
<div class="osu-layout__section osu-layout__section--full">
   <div class="osu-layout__row osu-layout__row--with-gutter faq-listing">
        <div class="wide col-sm-12">
            <div class="faq__row--page-main osu-layout__row--page">
                <ul class="faq__list-heading">
                    <li class="faq__list-heading--header faq__list-heading--item"><h2>{{$category->title}}</h2></li>
                    @foreach ($category->articles as $article)
                   		<li class="faq__list-heading--item faq__list-heading--link"><a href="/help/faq/view/{{$article->id}}">{{$article->title}}</a></li>
                    @endforeach
                </ul>
	            <div class="forum-post__actions">
		            <div class="forum-post-actions">
			            <a class="forum-post-actions__action" href="/help/faq/create/{{$category->id}}">
			            	<i class="fa fa-plus"></i>
			            </a>
		            </div>
	            </div>
            </div>
        </div>
</div>
@endsection
