<div class="p2">
    <input type="hidden" id="id" name="id" value="{{$slider->id}}">
    <div class="form-group">
        <label for="image">Ảnh</label>
        <input type="file" name="image" id="image"  class="form-control" onChange="readURL(this);">
        <img id="img" class="mt-3" style="width: 100px;height: 100px;display: none" alt="">
        <img src="{{asset('assets/images/banners')}}/{{$slider->image}}" id="oldimg" name="oldimage" class="mt-3" style="width: 100px;height: 100px;" alt="">
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
