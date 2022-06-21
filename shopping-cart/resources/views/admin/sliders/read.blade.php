@if (count($sliders)>0)
<div class="table-responsive mt-4">
    <table class="table table-striped table-bordered ">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Subtitle</th>
                <th>Price</th>
                <th>Status</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="tbody">
                @foreach ($sliders as $item)                                                                         
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->subtitle}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->status}}</td>
                        <td><img src="{{asset('assets/images/sliders')}}//{{$item->image}}" alt=""></td>
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
    {!!$sliders->render()!!}
</div>
@else
<p>Không tìm thấy danh mục nào phù hợp</p>
@endif
