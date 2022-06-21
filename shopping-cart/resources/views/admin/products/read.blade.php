@if (count($products)>0)
<div class="table-responsive mt-4">
    <table class="table table-striped table-bordered ">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Giá sale</th>
                <th>Tình trạng</th>
                <th>Số lượng</th>
                <th>Ảnh</th>
                <th>Tên danh mục</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="tbody">
                @foreach ($products as $item)                                                                         
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>
                            @php
                                echo number_format($item->regular_price, 0, ',', '.').'đ';
                            @endphp
                        </td>
                        <td>
                            @php
                                echo number_format($item->sale_price, 0, ',', '.').'đ';
                            @endphp
                        </td>
                        <td>{{$item->stock_status}}</td>
                        <td>{{$item->quantity}}</td>
                        <td><img src="{{asset('assets/images/products')}}/{{$item->image}}" ></td>
                        <td>{{$item->category->name}}</td>
                        
                        <td>
                            <a data-href="{{$item->id}}" class="btn icon btn-primary edit"  style="margin: 0px 15px">
                                <i class="ti-pencil"></i>
                            </a>
                            <a data-href="{{$item->id}}" class="btn icon btn-danger remove">
                                <i class="ti-trash"></i>
                            </a>
                        </td>
                            
                    </tr>
                @endforeach
            </tbody>
            
    </table>
    
</div>
<div class="mt-2">
    {!!$products->render()!!}
</div>
@else
    <p>Không tìm thấy sản phẩm nào phù hợp</p>
@endif