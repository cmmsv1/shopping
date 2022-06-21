@extends('layouts.dashboard')
@section('admin')
    <div class="container">
        <div class="px-5 py-5">   
            <h3 class="text-center">Social</h3> 
            @if ($social)
                <form method="post" id="social">
                    @csrf
                    <div class="form-group">   
                        <label for="">Facebook</label>               
                        <input class="form-control" type="text" value="{{$social->facebook}}" name="facebook" placeholder="Facebook ...">     
                    </div>
                    <div class="form-group">   
                        <label for="">Twitter</label>               
                        <input class="form-control" type="text" value="{{$social->twitter}}"  name="twitter" placeholder="Twitter ...">     
                    </div>
                    <div class="form-group">   
                        <label for="">Instagram</label>               
                        <input class="form-control" type="text" value="{{$social->instagram}}"  name="instagram" placeholder="Instagram ...">     
                    </div>
                    <div class="form-group">   
                        <label for="">Pinterest</label>               
                        <input class="form-control" type="text" value="{{$social->pinterest}}"  name="pinterest" placeholder="Pinterest ...">     
                    </div>
                    <div class="form-group">   
                        <label for="">Vimeo</label>                
                        <input class="form-control" type="text" value="{{$social->vimeo}}"  name="vimeo" placeholder="Vimeo ...">     
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>      
            @else
                <form method="post" id="social">
                    @csrf
                    <div class="form-group">   
                        <label for="">Facebook</label>               
                        <input class="form-control" type="text"  name="facebook" placeholder="Facebook ...">     
                    </div>
                    <div class="form-group">   
                        <label for="">Twitter</label>               
                        <input class="form-control" type="text"   name="twitter" placeholder="Twitter ...">     
                    </div>
                    <div class="form-group">   
                        <label for="">Instagram</label>               
                        <input class="form-control" type="text"   name="instagram" placeholder="Instagram ...">     
                    </div>
                    <div class="form-group">   
                        <label for="">Pinterest</label>               
                        <input class="form-control" type="text"  name="pinterest" placeholder="Pinterest ...">     
                    </div>
                    <div class="form-group">   
                        <label for="">Vimeo</label>                
                        <input class="form-control" type="text"   name="vimeo" placeholder="Vimeo ...">     
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>      
            @endif     
                 
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#social').submit(function (e) { 
                e.preventDefault();
                var data = new FormData(this);
                $.ajax({
                    type: "post",
                    url: "{{route('admin.custom.social.update')}}",
                    data: data,
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    success: function (response) {
                        swal({
                            title: "Success!",
                            text: response.message,
                            icon: "success",
                        });
                    }
                });
            });
        });
    </script>
@endsection