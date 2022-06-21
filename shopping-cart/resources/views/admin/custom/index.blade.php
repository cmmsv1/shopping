@extends('layouts.dashboard')
@section('admin')
    <div class="container">
        <div class="px-5 py-5">         
            <div class="mt-3"><a href="{{route('admin.custom.logo')}}" class="btn btn-primary">Thay đổi logo</a></div> 
            <div class="mt-3"><a href="{{route('admin.custom.info')}}" class="btn btn-primary">Thay đổi Info</a></div> 
            <div class="mt-3"><a href="{{route('admin.custom.social')}}" class="btn btn-primary">Thay đổi link social</a></div>             
        </div>
    </div>
@endsection