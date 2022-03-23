@extends('index')
@section('meta_tags')
    <title>{{trans('messages.verifyPhoneNumber')}}</title>
@endsection
@section('meta_css')

@endsection
@section('content')
    <div class="container align-content-center">
        <div class="col-sm-6 col-lg-6 mx-auto d-block mt-5">
            @livewire('auth.verify',[
            'phone_number'=> auth()->user()->phone_number
            ])
        </div>
    </div>
@endsection
@section('meta_js')

@endsection
