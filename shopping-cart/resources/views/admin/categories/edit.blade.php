<div class="p2">
    <input type="hidden" id="id" name="id" value="{{ $category->id}}">
    <div class="form-group">
        <input type="text" name="name" id="name" value="{{ $category->name }}" class="form-control"
            placeholder="name product">
    </div>
    <div class="form-group">
        <label for="my-select">Chọn danh mục cha</label>
        <select id="my-select" class="form-control" name="parent_id">
            <option value="0" selected>Danh mục cha</option>
            @foreach ($categories as $item)
                    <option style="font-size: 18px" value="{{$item->id}}" {{$item->id == $category->parent_id ? 'selected':''}}>
                        {{$item->name}}
                    </option>
                    @foreach ($item->children as $child)
                        <option style="font-size: 15px" value="{{$child->id}}"  {{$child->id == $category->parent_id ? 'selected':''}}>
                            -- {{$child->name}}
                        </option>
                        {{-- @foreach ($child->children as $chi)
                        <option style="font-size: 13px" value="{{$chi->id}}">
                            ---- {{$chi->name}}
                        </option>
                        @endforeach --}}
                    @endforeach
            @endforeach
        </select>
    </div>
    <div class="form-group mt-2">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>  
</div>