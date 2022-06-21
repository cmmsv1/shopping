@extends('layouts.app')
@section('content')
@php
    $path = explode('/',Request::path())[1];
@endphp
<main id="main" class="main-site left-sidebar">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="{{route('home')}}" class="link">home</a></li>
                <li class="item-link"><span>Search</span></li>
                @if ($category_name)
                    <li class="item-link"><span>{{$category_name}}</span></li>
                @endif
                @if ($category_id)
                    <input type="hidden" id="search_top_id" value="{{$category_id}}">
                @endif
               
            </ul>
        </div>
        <div class="row">

            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">

                <div class="wrap-shop-control">
                    @if ($category_name)
                        <h1 class="shop-title">{{$category_name}}</h1>
                    @endif
                    

                    <div class="wrap-right" id="order" style="margin-left: auto; display:flex;">

                        <div class="order" style="display:flex; margin:auto">
                             <div class="sort-item orderby" style="margin-right: 20px">
                                 <select name="orderby" id="sort" style="padding: 2px 0px;border-radius:3px">
                                    <option value="default" selected="selected">Sắp xếp mặc định</option>
                                    <option value="date">Mới nhất</option>
                                    <option value="price">Sắp xếp theo giá: Thấp đến cao</option>
                                    <option value="price-desc">Sắp xếp theo giá: Cao xuống thấp</option>
                                 </select>
                             </div>
 
                             <div class="sort-item product-per-page">
                                 <select name="post-per-page" id="paginate-page" style="padding: 2px 0px;border-radius:3px">
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
                    @include('search.readCategories')
                </div>
                <input type="hidden" value="1" id="hidden_page" >
            </div><!--end main products area-->
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                <div class="widget mercado-widget categories-widget" style="margin-top: 50px">
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
                            {{-- @foreach ($categories as $category)                    
                                @if ($category->slug == $path)
                                    <li class="category-item active">
                                        <a href="{{route('search.categories',$category->slug)}}" class="cate-link">{{$category->name}}</a>
                                    </li>
                                @else 
                                    <li class="category-item">
                                        <a href="{{route('search.categories',$category->slug)}}" class="cate-link">{{$category->name}}</a>
                                    </li>
                                @endif
                            @endforeach --}}
                        </ul>
                    </div>
                </div><!-- Categories widget-->
            </div>
        </div><!--end row-->

    </div><!--end container-->

</main>
<script>
   $(document).ready(function () {
       var category_id = $('#search_top_id').val();
       var base_url = 'http://localhost:8000/';

       // lấy data add vào read
       function fetch_data(page,pageSize=null,sortName='',category_id){
            $.ajax({
                url: base_url+'search/readCategories?page='+page+"&pageSize="+pageSize+"&sortName="+sortName+'&category_id='+category_id,
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
            fetch_data(page,pageSize,sortName,category_id);
        });
        // sort
        $(document).on('change', '#sort',function() { 
            var sortName = $(this).val();
            var pageSize = $('#paginate-page').val();
            var page = $("#hidden_page").val();
            fetch_data(page,pageSize,sortName,category_id);
        });
        // phân trang ajax
        $(document).on('click', '.pagination a',function(event)
        {
            event.preventDefault();
            var page=$(this).attr('href').split('page=')[1];
            var sortName = $(this).closest('.main-content-area').find('#sort').val();
            var pageSize = $(this).closest('.main-content-area').find('#paginate-page').val();
            fetch_data(page,pageSize,sortName,category_id);
            window.scroll({
                top: 500,
                behavior: 'smooth'
            });
        });
   });
</script>
@endsection