<div class="p2">
    <input type="hidden" id="id" name="id" value="">
    <div class="form-group">
        <label for="">Tên danh mục</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Tên danh mục">
        <span style="color: red;font-size: 12px;margin-top: 10px" class="name_error"></span>
    </div>
    <div class="form-group">
        <label for="my-select">Chọn danh mục cha</label>
        <select id="my-select" class="form-control" name="parent_id">
            <option value="0" style="font-size: 18px" selected>Danh mục cha</option>
            @foreach ($categories as $item)
                    <option style="font-size: 18px" value="{{$item->id}}">
                        {{$item->name}}
                    </option>
                    {{-- @foreach ($item->children as $child)
                        <option style="font-size: 15px" value="{{$child->id}}">
                            -- {{$child->name}}
                        </option>
                        {{-- @foreach ($child->children as $chi)
                        <option style="font-size: 13px" value="{{$chi->id}}">
                            ---- {{$chi->name}}
                        </option>
                        @endforeach --}}
                    {{-- @endforeach --}}
            @endforeach
        </select>

    </div>
    <div class="form-group mt-2">
        <button type="submit" class="btn btn-success">Thêm</button>
    </div>
</div>
