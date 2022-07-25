<?php //echo "<pre>";print_r($categorySliders); die(); ?>
@if(!empty($categorySliders[0]))
    @foreach($categorySliders[0]->images as $banner)
        <div class="item">
            <div class="brand-subscribe d-flex justify-content-between align-items-center">
                <div class="w-50 text-center">
                    <h3>style now <br> pay later with us</h3>
                    <p>There's nothing more glamorous than a holiday-ready home.</p>
                    @if($categorySliders[0]->link_type == 'internal')
                        <a href="{{ url('category/'. $categorySliders[0]->rawslug) }}">Click Here</a>
                    @else
                        <a href="{{ $categorySliders[0]->link }}">Click Here</a>
                    @endif

                </div>
                <figure class="w-50 mb-0 h-50">
                    <img src="{{ asset('storage/'.$banner->name) }}" class="img-fluid h-100" alt="">
                </figure>
            </div>
        </div>
    @endforeach
@endif