@extends('layouts.app')
@section('content')
<main id="main" class="main-site left-sidebar">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">home</a></li>
                <li class="item-link"><span>Shop</span></li>
            </ul>
        </div>
        <div class="row">

            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">

                <div class="banner-shop">
                    <a href="#" class="banner-link">
                        <figure><img src="{{asset('assets/images/shop-banner.jpg')}}" alt=""></figure>
                    </a>
                </div>

                <div class="wrap-shop-control">

                    <h1 class="shop-title">Shop</h1>

                    <div class="wrap-right" style="margin-left: auto; display:flex;">

                       <div class="order" style="display:flex; margin:auto">
                            <div class="sort-item orderby" style="margin-right: 20px">
                                <select name="orderby"  id="sort" style="padding: 4px 0px;border-radius:3px">
                                    <option value="default" selected="selected">Sắp xếp mặc định</option>
                                     <option value="date">Mới nhất</option>
                                     <option value="price">Sắp xếp theo giá: Thấp đến cao</option>
                                     <option value="price-desc">Sắp xếp theo giá: Cao xuống thấp</option>
                                </select>
                            </div>

                            <div class="sort-item product-per-page">
                                <select name="post-per-page" id="paginate-page" style="padding: 4px 0px;border-radius:3px">
                                    <option value="12" selected="selected">12 per page</option>
                                    <option value="15">15 per page</option>
                                    <option value="21">21 per page</option>
                                    <option value="34">34 per page</option>
                                </select>
                            </div>
                       </div>

                        <div class="change-display-mode">
                            <a href="#" class="grid-mode display-mode active"><i class="fa fa-th"></i>Grid</a>
                            {{-- <a href="list.html" class="list-mode display-mode"><i class="fa fa-th-list"></i>List</a> --}}
                        </div>

                    </div>

                </div><!--end wrap shop control-->

                <div class="row" id="products">
                    @include('shop.read')
                </div>
                <input type="hidden" value="1" id="hidden_page" >
            </div><!--end main products area-->

            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                <div class="widget mercado-widget categories-widget">
                    <h2 class="widget-title">All Categories</h2>
                    <div class="widget-content">
                        <ul class="list-category">
                            @foreach ($categories as $item)
                                <li class="category-item has-child-cate">
                                    <a href="{{route('search.parentcategories',$item->slug)}}" class="cate-link">
                                        {{$item->name}}
                                    </a>
                                    @if(count($item->children) > 0 )
                                        <span class="toggle-control">+</span>
                                        <ul class="sub-cate">
                                            @foreach ($item->children as $child)
                                                <li class="category-item">
                                                    <a href="{{route('search.categories',$child->slug)}}" class="cate-link">
                                                        {{$child->name}}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif                             
                                </li>
                                
                            @endforeach
                        </ul>
                    </div>
                </div><!-- Categories widget-->

                <div class="widget mercado-widget filter-widget brand-widget">
                    <h2 class="widget-title">Brand</h2>
                    <div class="widget-content">
                        <ul class="list-style vertical-list list-limited" data-show="5">
                            @foreach ($categories as $item)
                                
                                @if($loop->iteration > 2)
                                    @if(count($item->children) > 0 )
                                        @foreach ($item->children as $child)

                                            <li class="list-item default-hiden">
                                                <a href="{{route('search.categories',$child->slug)}}" class="filter-link">
                                                    {{$child->name}}
                                                </a>
                                            </li>        
                                        @endforeach
                                    @endif  
                                @else
                                    @if(count($item->children) > 0 )
                                        @foreach ($item->children as $child) 
                                            <li class="list-item">
                                                <a href="{{route('search.categories',$child->slug)}}" class="filter-link">
                                                    {{$child->name}}
                                                </a>
                                            </li> 
                                        @endforeach
                                    @endif 
                                @endif                         
                            @endforeach
                            {{-- <li class="list-item"><a class="filter-link active" href="#">Fashion Clothings</a></li>
                            <li class="list-item"><a class="filter-link " href="#">Laptop Batteries</a></li>
                            <li class="list-item"><a class="filter-link " href="#">Printer & Ink</a></li>
                            <li class="list-item"><a class="filter-link " href="#">CPUs & Prosecsors</a></li>
                            <li class="list-item"><a class="filter-link " href="#">Sound & Speaker</a></li>
                            <li class="list-item"><a class="filter-link " href="#">Shop Smartphone & Tablets</a></li>
                            <li class="list-item default-hiden"><a class="filter-link " href="#">Printer & Ink</a></li>
                            <li class="list-item default-hiden"><a class="filter-link " href="#">CPUs & Prosecsors</a></li>
                            <li class="list-item default-hiden"><a class="filter-link " href="#">Sound & Speaker</a></li>
                            <li class="list-item default-hiden"><a class="filter-link " href="#">Shop Smartphone & Tablets</a></li> --}}
                            <li class="list-item"><a data-label='Show less<i class="fa fa-angle-up" aria-hidden="true"></i>' class="btn-control control-show-more" href="#">Show more<i class="fa fa-angle-down" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div><!-- brand widget-->

                <div class="widget mercado-widget filter-widget price-filter">
                    <h2 class="widget-title">Price</h2>
                    <div class="widget-content">
                        <div id="slider-range"></div>
                        <p>
                            <label for="amount">Price:</label>
                            <input type="text" id="amount" readonly>
                            <button class="filter-submit">Filter</button>
                        </p>
                    </div>
                </div><!-- Price-->

                {{-- <div class="widget mercado-widget filter-widget">
                    <h2 class="widget-title">Color</h2>
                    <div class="widget-content">
                        <ul class="list-style vertical-list has-count-index">
                            <li class="list-item"><a class="filter-link " href="#">Red <span>(217)</span></a></li>
                            <li class="list-item"><a class="filter-link " href="#">Yellow <span>(179)</span></a></li>
                            <li class="list-item"><a class="filter-link " href="#">Black <span>(79)</span></a></li>
                            <li class="list-item"><a class="filter-link " href="#">Blue <span>(283)</span></a></li>
                            <li class="list-item"><a class="filter-link " href="#">Grey <span>(116)</span></a></li>
                            <li class="list-item"><a class="filter-link " href="#">Pink <span>(29)</span></a></li>
                        </ul>
                    </div>
                </div><!-- Color --> --}}

                {{-- <div class="widget mercado-widget filter-widget">
                    <h2 class="widget-title">Size</h2>
                    <div class="widget-content">
                        <ul class="list-style inline-round ">
                            <li class="list-item"><a class="filter-link active" href="#">s</a></li>
                            <li class="list-item"><a class="filter-link " href="#">M</a></li>
                            <li class="list-item"><a class="filter-link " href="#">l</a></li>
                            <li class="list-item"><a class="filter-link " href="#">xl</a></li>
                        </ul>
                        <div class="widget-banner">
                            <figure><img src="{{asset('assets/images/size-banner-widget.jpg')}}" width="270" height="331" alt=""></figure>
                        </div>
                    </div>
                </div><!-- Size --> --}}

                <div class="widget mercado-widget widget-product" style="margin-top: 50px">
                    <h2 class="widget-title">Popular Products</h2>
                    <div class="widget-content">
                        <ul class="products">
                            @foreach ($product_popular as $item)
                                
                            
                            <li class="product-item">
                                <div class="product product-widget-style">
                                    <div class="thumbnnail">
                                        <a href="{{route('product.detail',$item->slug)}}" title="{{$item->name}}">
                                            <figure><img src="{{asset('assets/images/products')}}//{{$item->image}}" alt="{{$item->name}}"></figure>
                                        </a>
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
                            </li>
                            @endforeach

                        </ul>
                    </div>
                </div><!-- brand widget-->

            </div><!--end sitebar-->

        </div><!--end row-->

    </div><!--end container-->

</main>

@endsection
@section('script')
    
<script>
    $(document).ready(function () {
        // lấy data add vào read
        function fetch_data(page,pageSize=null,sortName=''){
            $.ajax({
                url: 'shop/read?page='+page+"&pageSize="+pageSize+"&sortName="+sortName,
                success: function(data){
                    $('#products').html(data);
                }
            });
        }
        // paginate
        $(document).on('change', '#paginate-page',function() { 
            var pageSize = $(this).val();
            var sortName = $('#sort').val();
            var page = $("#hidden_page").val();
            fetch_data(page,pageSize,sortName);
        });
        // sort
        $(document).on('change', '#sort',function() { 
            var sortName = $(this).val();
            var pageSize = $('#paginate-page').val();
            var page = $("#hidden_page").val();
            fetch_data(page,pageSize,sortName);
        });
        // phân trang ajax
        $(document).on('click', '.pagination a',function(event)
        {
            event.preventDefault();
            var page=$(this).attr('href').split('page=')[1];
            var sortName = $(this).parent().parent().parent().parent().parent().parent().parent().find('#sort').val();
            var pageSize = $(this).parent().parent().parent().parent().parent().parent().parent().find('#paginate-page').val();
            fetch_data(page,pageSize,sortName);
            document.documentElement.scrollTop = 400;
        });

    });

    
</script>
@endsection