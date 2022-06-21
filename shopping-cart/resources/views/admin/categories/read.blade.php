@if (count($categories)>0)
<div class="table-responsive mt-4">
    <table class="table table-striped table-bordered ">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Danh mục cha</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="tbody">
                @foreach ($categories as $item)                                                                         
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->slug}}</td>
                        @if ($item->parent_id == 0)
                            <td>Danh mục cha</td>
                        @else
                            <td>{{$item->parent->name}}</td>
                        @endif
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
    {!!$categories->render()!!}
</div>
@else
<p>Không tìm thấy danh mục nào phù hợp</p>
@endif
