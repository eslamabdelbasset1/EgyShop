@php
    $brands = \App\Models\Brand::latest()->get();
@endphp

<div id="brands-carousel" class="logo-slider wow fadeInUp">
    <div class="logo-slider-inner">
        <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
            @foreach ($brands as $brand)
                <div class="item m-t-15">
                    <a href="#" class="image">
                        <img data-echo="{{asset($brand->brand_image)}}"
                             src="{{asset($brand->brand_image)}}')}}" style="width: 65px" alt="{{$brand->brand_name_en}}">
                    </a>
                </div>
            @endforeach
            <!--/.item-->
        </div>
        <!-- /.owl-carousel #logo-slider -->
    </div>
    <!-- /.logo-slider-inner -->

</div>
