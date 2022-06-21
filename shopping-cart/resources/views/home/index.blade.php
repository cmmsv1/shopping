@extends('layouts.app')
@section('content')
@php
    use App\Models\Category;
    use App\Models\Product;
@endphp
<main id="main">
    <div class="container">

        <!--MAIN SLIDE-->
        <div class="wrap-main-slide">
            <div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
                <div class="item-slide">
                    <img src="{{asset('assets/images/main-slider-1-1.jpg')}}" alt="" class="img-slide">
                    <div class="slide-info slide-1">
                        <h2 class="f-title">Kid Smart <b>Watches</b></h2>
                        <span class="subtitle">Compra todos tus productos Smart por internet.</span>
                        <p class="sale-info">Only price: <span class="price">$59.99</span></p>
                        <a href="#" class="btn-link">Shop Now</a>
                    </div>
                </div>
                <div class="item-slide">
                    <img src="{{asset('assets/images/main-slider-1-2.jpg')}}" alt="" class="img-slide">
                    <div class="slide-info slide-2">
                        <h2 class="f-title">Extra 25% Off</h2>
                        <span class="f-subtitle">On online payments</span>
                        <p class="discount-code">Use Code: #FA6868</p>
                        <h4 class="s-title">Get Free</h4>
                        <p class="s-subtitle">TRansparent Bra Straps</p>
                    </div>
                </div>
                <div class="item-slide">
                    <img src="{{asset('assets/images/main-slider-1-3.jpg')}}" alt="" class="img-slide">
                    <div class="slide-info slide-3 ">
                        <h2 class="f-title">Great Range of <b>Exclusive Furniture Packages</b></h2>
                        <span class="f-subtitle">Exclusive Furniture Packages to Suit every need.</span>
                        <p class="sale-info">Stating at: <b class="price">$225.00</b></p>
                        <a href="#" class="btn-link">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>

        <!--BANNER-->
        <div class="wrap-banner style-twin-default">
            <div class="banner-item">
                <a href="#" class="link-banner banner-effect-1">
                    <figure><img src="{{asset('assets/images/home-1-banner-1.jpg')}}" alt="" width="580" height="190"></figure>
                </a>
            </div>
            <div class="banner-item">
                <a href="#" class="link-banner banner-effect-1">
                    <figure><img src="{{asset('assets/images/home-1-banner-2.jpg')}}" alt="" width="580" height="190"></figure>
                </a>
            </div>
        </div>

        <!--On Sale-->
        @if (count($products_sale)>0) 
        <div class="wrap-show-advance-info-box style-1 has-countdown">
            <h3 class="title-box">On Sale</h3>
            <div class="wrap-countdown mercado-countdown" data-expire="2020/12/12 12:34:56"></div>
            <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                   
                    @foreach ($products_sale as $item)   
                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="{{route('product.detail',$item->slug)}}" title="{{$item->name}}">
                                    <figure><img src="{{asset('assets/images/products')}}/{{$item->image}}" width="800" height="800" alt="{{$item->name}}"></figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item sale-label">sale</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="{{route('product.detail',$item->slug)}}" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="{{route('product.detail',$item->slug)}}" class="product-name"><span>{{$item->name}}</span></a>
                                <div class="wrap-price">
                                    <ins>
                                        <p class="product-price">
                                            @php
                                                echo number_format($item->sale_price, 0, ',', '.').'đ';
                                            @endphp
                                        </p>
                                    </ins> 
                                    <del>
                                        <p class="product-price">
                                            @php
                                                echo number_format($item->regular_price, 0, ',', '.').'đ';
                                            @endphp
                                        </p>
                                    </del>
                                </div>
                            </div>
                        </div>
                    @endforeach
                
            </div>
        </div>
        @endif
        <!--Latest Products-->
        <div class="wrap-show-advance-info-box style-1">
            <h3 class="title-box">Latest Products</h3>
            <div class="wrap-top-banner">
                <a href="#" class="link-banner banner-effect-2">
                    <figure><img src="{{asset('assets/images/digital-electronic-banner.jpg')}}" width="1170" height="240" alt=""></figure>
                </a>
            </div>
            <div class="wrap-products">
                <div class="wrap-product-tab tab-style-1">						
                    <div class="tab-contents">
                        <div class="tab-content-item active" id="digital_1a">
                            <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
                                @foreach ($products_latest as $item)
                                    
                                <div class="product product-style-2 equal-elem ">
                                    <div class="product-thumnail">
                                        <a href="{{route('product.detail',$item->slug)}}" title="{{$item->name}}">
                                            <figure><img src="{{asset('assets/images/products')}}/{{$item->image}}" width="800" height="800" alt="{{$item->name}}"></figure>
                                        </a>
                                        <div class="group-flash">
                                            <span class="flash-item new-label">new</span>
                                            @if ($item->sale_price > 0)
                                                <span class="flash-item sale-label">sale</span>
                                            @endif
                                        </div>
                                        
                                        <div class="wrap-btn">
                                            <a href="{{route('product.detail',$item->slug)}}" class="function-link">quick view</a>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <a href="{{route('product.detail',$item->slug)}}" class="product-name"><span>{{$item->name}}</span></a>
                                        <div class="wrap-price">
                                            @if ($item->sale_price > 0)
                                                <ins>
                                                    <p class="product-price">
                                                        @php
                                                            echo number_format($item->sale_price, 0, ',', '.').'đ';
                                                        @endphp
                                                    </p>
                                                </ins> 
                                                <del>
                                                    <p class="product-price">
                                                        @php
                                                            echo number_format($item->regular_price, 0, ',', '.').'đ';
                                                        @endphp
                                                    </p>
                                                </del>
                                            @else
                                                <span class="product-price">
                                                    @php
                                                        echo number_format($item->regular_price, 0, ',', '.').'đ';
                                                    @endphp
                                                </span>
                                            @endif 
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                
                            </div>
                        </div>							
                    </div>
                </div>
            </div>
        </div>

        <!--Product Categories-->
        <div class="wrap-show-advance-info-box style-1">
            <h3 class="title-box">Product Categories</h3>
            <div class="wrap-top-banner">
                <a href="#" class="link-banner banner-effect-2">
                    <figure><img src="{{asset('assets/images/fashion-accesories-banner.jpg')}}" width="1170" height="240" alt=""></figure>
                </a>
            </div>
            <div class="wrap-products">
                <div class="wrap-product-tab tab-style-1">
                    <div class="tab-control">
                        @foreach ($categories_parent as $item)
                     
                            <a href="#category_{{$item->id}}" data-slug="{{$item->slug}}" class="tab-control-item {{$loop->index ==0?'active':''}}">{{$item->name}}</a>
                        @endforeach
                    </div>
                    <div class="tab-contents" id="tab-contents">
                        @foreach ($categories_parent as $item)
                            <div class="tab-content-item {{$loop->index ==0?'active':''}}" id="category_{{$item->id}}">
                                <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >                                  
                                    
                                        @php
                                            $category_parent_id = $item->id;
                                            $category_chidren_id = Category::getArrayChildren($category_parent_id);
                                            $products = Product::whereIn('category_id', $category_chidren_id)->take(8)->get();
                                        @endphp
                                        @foreach ($products as $item)   
                                        <div class="product product-style-2 equal-elem ">
                                            <div class="product-thumnail">
                                                <a href="{{route('product.detail',$item->slug)}}" title="{{$item->name}}">
                                                    <figure><img src="{{asset('assets/images/products')}}/{{$item->image}}" width="800" height="800" alt="{{$item->name}}"></figure>
                                                </a>
                                                <div class="group-flash">
                                                    @if ($item->sale_price > 0)
                                                        <span class="flash-item sale-label">sale</span>
                                                    @endif
                                                </div>
                                                <div class="wrap-btn">
                                                    <a href="{{route('product.detail',$item->slug)}}" class="function-link">quick view</a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <a href="{{route('product.detail',$item->slug)}}" class="product-name"><span>{{$item->name}}</span></a>
                                                <div class="wrap-price">
                                                    @if ($item->sale_price > 0)
                                                        <ins>
                                                            <p class="product-price">
                                                                @php
                                                                    echo number_format($item->sale_price, 0, ',', '.').'đ';
                                                                @endphp
                                                            </p>
                                                        </ins> 
                                                        <del>
                                                            <p class="product-price">
                                                                @php
                                                                    echo number_format($item->regular_price, 0, ',', '.').'đ';
                                                                @endphp
                                                            </p>
                                                        </del>
                                                    @else
                                                        <span class="product-price">
                                                            @php
                                                                echo number_format($item->regular_price, 0, ',', '.').'đ';
                                                            @endphp
                                                        </span>
                                                    @endif 
                                                </div>
                                            </div>
                                        </div>     
                                        @endforeach
                                                              
                                </div>
                            </div>
                            @endforeach   
                    </div>
                </div>
            </div>
        </div>			

    </div>

</main>
@endsection