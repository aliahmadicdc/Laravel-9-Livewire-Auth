@extends('index')
@section('meta_tags')
    <title>{{trans('messages.loginTitle')}}</title>
@endsection
@section('meta_css')

@endsection
@section('content')
    <div class="container align-content-center">
        <div class="col-sm-6 col-lg-6 mx-auto d-block mt-5">
            @livewire('auth.login')
        </div>
    </div>
@endsection
@section('meta_js')

@endsection
