<div class="p2">
    <input type="hidden" id="id" name="id" value="">
    <div class="form-group">
        <input type="hidden" id="id" name="id" value="{{$slider->id}}">
        <label for="image">Tiêu đề</label>
        <input type="text" name="title" class="form-control" value="{{$slider->title}}" placeholder="Tiêu đề ....">
        <span style="color: red;font-size: 12px;margin-top: 10px" class="title_error"></span>
    </div>
    <div class="form-group">
        <label for="image">Mô tả</label>
        <input type="text" name="subtitle" class="form-control" value="{{$slider->subtitle}}" placeholder="Mô tả ...">
        <span style="color: red;font-size: 12px;margin-top: 10px" class="subtitle_error"></span>
    </div>
    <div class="form-group">
        <label for="image">Giá</label>
        <input type="number" name="price" class="form-control" value="{{$slider->price}}" placeholder="Giá ....">
        <span style="color: red;font-size: 12px;margin-top: 10px" class="price_error"></span>
    </div>
    <div class="form-group">
        <label>Tình trạng</label>
        <select class="form-control" name="status">
            @if ($slider->status == 1)
                <option value="1" selected>active</option>
                <option value="0">inactive</option>
            @else
                <option value="1">active</option>
                <option value="0" selected>inactive</option>
            @endif
            
        </select>
    </div>
    <div class="form-group">
        <label for="image">Ảnh</label>
        <input type="file" name="image" id="image"  class="form-control" onChange="readURL(this);">
        <img id="img" class="mt-3" style="width: 100px;height: 100px;display: none" alt="">
        <img src="{{asset('assets/images/sliders')}}/{{$slider->image}}" id="oldimg" name="oldimage" class="mt-3" style="width: 100px;height: 100px;" alt="">
        <span style="color: red;font-size: 12px;margin-top: 10px" class="image_error"></span>
    </div>
    <div class="form-group mt-2">
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </div>
</div>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img').show();
                $('#oldimg').hide();
                $('#img').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
