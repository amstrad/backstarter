@extends('admin.layout')
@section('content')


    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <router-view></router-view>

            </div>
        </div>
        @include('admin.partials.footer')
    </div>

@endsection