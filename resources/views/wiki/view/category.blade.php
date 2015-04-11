<h2>Category: {{ $cat_name }}</h2>
@if ($revision)
    @include('wiki.view.revision-content', ['revision' => $revision])
@else
    <p>
        No information for this category has been entered yet. You can change this by creating the category page by
        <a href="{{ act('wiki', 'create', 'category:'.$cat_name) }}">clicking here</a>.
    </p>
@endif

<h4>Pages in this category</h4>

<ul>
    @foreach ($cat_pages as $page)
        <li><a href="{{ act('wiki', 'page', $page->slug) }}">{{ $page->title }}</a></li>
    @endforeach
</ul>

{!! $cat_pages->render() !!}

@include('wiki.view.revision-categories', ['revision' => $revision])