@extends('index')
@section('meta_tags')
    <title>{{trans('messages.passwordResetTitle')}}</title>
@endsection
@section('meta_css')

@endsection
@section('content')
    <div class="container align-content-center">
        <div class="col-sm-6 col-lg-6 mx-auto d-block mt-5">
            @livewire('auth.password-reset',[
            'phone_number' => $phone_number,
            'token' => $token
            ])
        </div>
    </div>
@endsection
@section('meta_js')

@endsection
