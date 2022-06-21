<div class="p2">
    <input type="hidden" id="id" name="id" value="">
    <div class="form-group">
        <label for="image">Ảnh</label>
        <input type="file" name="image" id="image"  class="form-control" onChange="readURL(this);">
        <img id="img" class="mt-3" style="width: 100px;height: 100px;display: none" alt="">
        <span style="color: red;font-size: 12px;margin-top: 10px" class="image_error"></span>
    </div>
    <div class="form-group mt-2">
        <button type="submit" class="btn btn-success">Thêm</button>
    </div>
</div>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img').show();
                $('#img').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
