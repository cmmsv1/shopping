<ul class="product-list grid-products equal-container row">
    @foreach ($products as $item)     
        <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
            <div class="product product-style-3 equal-elem ">
                <div class="product-thumnail">
                    <a href="{{route('product.detail',$item->slug)}}" title="{{$item->name}}">
                        <figure><img style="width: 260px;height: 260px;" src="{{asset('assets/images/products')}}/{{$item->image}}" alt="{{$item->name}}"></figure>
                    </a>
                </div>
                <div class="product-info">
                    <a href="#" class="product-name"><span>{{$item->name}}</span></a>
                    <div class="wrap-price">
                        <span class="product-price">
                            @php
                                echo number_format($item->regular_price, 0, ',', '.').'đ';
                            @endphp
                        </span>
                    </div>
                    <a href="{{route('product.detail',$item->slug)}}" class="btn add-to-cart">Xem chi tiết</a>
                </div>
            </div>
        </li>
    @endforeach
</ul>
<div id="paginate">
    {!!$products->links()!!}
</div>