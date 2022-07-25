@if(!empty($footerCategory))
<ul class="list-inline">
    @foreach($footerCategory as $category)
        <li><a href="{{route('category', $category['slug'])}}">{{$category->translate(app()->getLocale())->name}}</a></li>
    @endforeach
</ul>
@endif