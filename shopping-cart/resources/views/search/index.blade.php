@extends('layouts.app')
@section('content')
<main id="main" class="main-site left-sidebar">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="{{route('home')}}" class="link">home</a></li>
                <li class="item-link"><span>Search</span></li>
                @if ($search)
                    <li class="item-link"><span>{{$search}}</span></li>
                    <input type="hidden" id="search_top_name" value="{{$search}}">
                @endif
               
            </ul>
        </div>
        <div class="row">

            <div class="col-lg-12 col-md-8 col-sm-8 col-xs-12 main-content-area">

                <div class="wrap-shop-control">

                    <h1 class="shop-title">Từ khoá tìm kiếm "{{$search}}"</h1>

                    <div class="wrap-right" style="margin-left: auto; display:flex;">

                        <div class="order" style="display:flex; margin:auto">
                             <div class="sort-item orderby" style="margin-right: 20px">
                                 <select name="orderby" class="use-chosen" id="sort" style="padding: 2px 0px;border-radius:3px">
                                     <option value="default" selected="selected">Sắp xếp mặc định</option>
                                     <option value="date">Mới nhất</option>
                                     <option value="price">Sắp xếp theo giá: Thấp đến cao</option>
                                     <option value="price-desc">Sắp xếp theo giá: Cao xuống thấp</option>
                                 </select>
                             </div>
 
                             <div class="sort-item product-per-page">
                                 <select name="post-per-page" class="use-chosen" id="paginate-page" style="padding: 2px 0px;border-radius:3px">
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
                    @include('search.read')
                </div>
                <input type="hidden" value="1" id="hidden_page" >
            </div><!--end main products area-->
        </div><!--end row-->

    </div><!--end container-->

</main>
<script>
   $(document).ready(function () {
       var search = $('#search_top_name').val();
       $('#search_top').val(search);

       // lấy data add vào read
       function fetch_data(page,pageSize=null,sortName='',search){
            $.ajax({
                url: 'search/read?page='+page+"&pageSize="+pageSize+"&sortName="+sortName+'&search='+search,
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
            fetch_data(page,pageSize,sortName,search);
        });
        // sort
        $(document).on('change', '#sort',function() { 
            var sortName = $(this).val();
            var pageSize = $('#paginate-page').val();
            var page = $("#hidden_page").val();
            fetch_data(page,pageSize,sortName,search);
        });
        // phân trang ajax
        $(document).on('click', '.pagination a',function(event)
        {
            event.preventDefault();
            var page=$(this).attr('href').split('page=')[1];
            var sortName = $(this).closest('.main-content-area').find('#sort').val();
            var pageSize = $(this).closest('.main-content-area').find('#paginate-page').val();
            fetch_data(page,pageSize,sortName,search);
            window.scroll({
                top: 500,
                behavior: 'smooth'
            });
        });
   });
</script>
@endsection