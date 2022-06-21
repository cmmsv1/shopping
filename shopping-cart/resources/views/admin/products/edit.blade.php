<style>
    #imgs img{
        margin: 5px 15px;
    }
</style>
<div class="p2">
    <div class="row">
        <div class="col-lg-6">
            <input type="hidden" id="id" name="id" value="{{$product->id}}">
            <div class="form-group">
                <label for="name">Tên danh mục</label>
                <input type="text" id="name" name="name" value="{{$product->name}}" class="form-control" placeholder="Tên danh mục...">
                <span style="color: red;font-size: 12px;margin-top: 10px" class="name_error"></span>
            </div>
            <div class="form-group">
                <label for="short_description">Mô tả ngắn</label>
                <textarea id="short_description" name="short_description" placeholder="Mô tả ngắn ...." class="form-control" rows="3">{{$product->short_description}}</textarea>
                <span style="color: red;font-size: 12px;margin-top: 10px" class="short_description_error"></span>
            </div>
            <div class="form-group">
                <label for="description">Mô tả chi tiết</label>
                <textarea id="description" name="description"  placeholder="Mô tả chi tiết ..." class="form-control" rows="4">{{$product->description}}</textarea>
                <span style="color: red;font-size: 12px;margin-top: 10px" class="description_error"></span>
            </div>
            <div class="form-group">
                <label for="regular_price">Giá bán</label>
                <input type="number" name="regular_price" value="{{$product->regular_price}}"  id="regular_price" class="form-control" placeholder="Giá bán ....">
                <span style="color: red;font-size: 12px;margin-top: 10px" class="regular_price_error"></span>
            </div>
            <div class="form-group">
                <label for="sale_price">Giá sale</label>
                <input type="number" name="sale_price" value="{{$product->sale_price}}" id="sale_price" class="form-control" placeholder="Giá sale ....">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="stock_status">Tình trạng</label>
                <select class="form-control" id="stock_status" name="stock_status" value="{{$product->stock_status}}">
                    @if ($product->stock_status == 'instock')
                        <option value="instock" selected>instock</option>
                        <option value="outofstock">outofstock</option>
                    @else
                        <option value="instock">instock</option>
                        <option value="outofstock" selected>outofstock</option>
                    @endif
                    
                    
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Số lượng</label>
                <input type="number" name="quantity" value="{{$product->quantity}}" id="quantity" class="form-control" placeholder="Số lượng ....">
                <span style="color: red;font-size: 12px;margin-top: 10px" class="quantity_error"></span>
            </div>
            <div class="form-group">
                <label for="category_id">Danh mục</label>
                <select class="form-control" id="category_id" name="category_id">
                    @foreach ($categories as $category)              
                        @if ($category->id === $product->category_id)
                            <option value="{{$category->id}}" selected>{{$category->name}}</option>
                        @else
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endif
                    @endforeach
                </select>
                <span style="color: red;font-size: 12px;margin-top: 10px" class="category_id_error"></span>
            </div>
            <div class="form-group">
                <label for="image">Ảnh đơn</label>
                <input type="file" name="image" id="image"  class="form-control" onChange="readURL(this);">
                <img id="img" class="mt-3" style="width: 100px;height: 100px;display: none" alt="">
                <img src="{{asset('assets/images/products')}}/{{$product->image}}" id="oldimg" name="oldimage" class="mt-3" style="width: 100px;height: 100px;" alt="">
                <span style="color: red;font-size: 12px;margin-top: 10px" class="image_error"></span>
            </div>
            <div class="form-group">
                <label for="images">Ảnh slider</label>
                <input type="file" id="images" name="images[]" class="form-control" multiple>
                
                <div id="imgs" class="mt-4">
                    @if ($product->images)
                        @foreach (json_decode($product->images) as $img)
                            <img src="{{asset('assets/images/products/products_slider')}}/{{$img}}" class="mt-3 oldimg" style="width: 100px;height: 100px;" alt="">     
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="form-group mt-2">
        <button class="btn btn-primary" type="submit">Cập nhật sản phẩm</button>
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
    var fileUpload = document.getElementById("images");
    fileUpload.onchange = function () {
        if (typeof (FileReader) != "undefined") {
            var dvPreview = document.getElementById("imgs");
            dvPreview.innerHTML = "";
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            for (var i = 0; i < fileUpload.files.length; i++) {
                var file = fileUpload.files[i];
                if (regex.test(file.name.toLowerCase())) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.oldimg').hide();
                        var img = document.createElement("IMG");
                        img.height = "100";
                        img.width = "100";
                        img.src = e.target.result;
                        dvPreview.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                } else {
                    alert(file.name + " is not a valid image file.");
                    dvPreview.innerHTML = "";
                    return false;
                }
            }
        } else {
            alert("This browser does not support HTML5 FileReader.");
        }
    }
</script>