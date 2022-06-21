<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">Role</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $item)                         
            <tr>
                <td class="text-center">{{$item->id}}</td>
                <td class="text-center">{{$item->name}}</td>
                <td class="text-center">{{$item->email}}</td>
                @if ($item->type == 'ADMIN')
                    <td class="text-center"><span style="padding: 10px;font-weight: bolder; color: rgb(226, 14, 96)">ADMIN</span></td>
                @else
                    <td class="text-center"><span style="padding: 10px;font-weight: bolder; color: rgb(83, 240, 104)">USER</span></td>
                @endif
                <td class="text-center">
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
{!! $users->links()!!}