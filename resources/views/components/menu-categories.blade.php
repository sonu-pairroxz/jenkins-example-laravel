<li class="top-level-link">
    <a class="mega-menu" href="{{route('interior')}}">
        <span>@lang("general.interior")</span>
    </a>
</li>
<li class="top-level-link">
    <a class="mega-menu" href="{{route('the-studio')}}">
        <span>@lang("general.the_studio")</span>
    </a>
</li>
@foreach($menuCategories as $category)
    <li class="top-level-link ">
        <a class="mega-menu" href="{{route('category', $category['slug'])}}"><span>{{$category->translate(app()->getLocale())->name}}</span></a>
    </li>
@endforeach
