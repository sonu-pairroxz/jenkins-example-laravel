<div class="container">
<div class="owl-carousel slider-carousel owl-theme">
	<?php //echo "<pre>";print_r($homeBanners); die(); ?>
	@if(!empty($homeBanners[0]))
	    @foreach($homeBanners[0]->images as $banner)
		    <div class="item">
		        <div class="slider-caption">
		            <figure>
		            	@if($homeBanners[0]->link_type == 'internal')
		            		<a href="{{ url('category/'. $homeBanners[0]->rawslug) }}"><img src="{{ asset('storage/'.$banner->name) }}" class="img-fluid" alt=""></a>
		            	@else
		            		<a href="{{ $homeBanners[0]->link }}"><img src="{{ asset('storage/'.$banner->name) }}" class="img-fluid" alt=""></a>
		            	@endif

		            </figure>
		        </div>
		    </div>
		@endforeach
	@endif

</div>
</div>
