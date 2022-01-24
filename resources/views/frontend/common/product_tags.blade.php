@php
    $tags_en = App\Models\Product::groupBy('product_tags_en')->select('product_tags_en')->get();
    $tags_ar = App\Models\Product::groupBy('product_tags_ar')->select('product_tags_ar')->get();
@endphp

<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title">Product tags</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="tag-list">
            @if(session()->get('language') == 'arabic')
                @foreach($tags_ar as $tag)
                    <a class="item active" title="Phone" href="{{ url('product/tag/'.$tag->product_tags_ar) }}">
                        {{ str_replace(',',' ',$tag->product_tags_ar)  }}</a>
                @endforeach
            @else
                @foreach($tags_en as $tag)
                    <a class="item active" title="Phone" href="{{ url('product/tag/'.$tag->product_tags_en) }}">
                        {{ str_replace(',',' ',$tag->product_tags_en)  }}</a>
                @endforeach
            @endif
        </div>
        <!-- /.tag-list -->
    </div>
    <!-- /.sidebar-widget-body -->
</div>
<!-- /.sidebar-widget -->
