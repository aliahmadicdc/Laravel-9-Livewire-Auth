@extends('index')
@section('meta_tags')
    <title>{{trans('messages.profile')}}</title>
@endsection
@section('meta_css')

@endsection
@section('content')
    <div class="container mb-5">
        <div class="mt-5 rounded p-3 bg-light text-right">
            @livewire('back.profile.edit-profile',[
            'user'=>$user
            ])

        </div>
        <div class="mt-2 rounded p-3 bg-light text-right">
            @livewire('back.profile.change-password',[
            'user'=>$user
            ])
        </div>
    </div>
@endsection
@section('meta_js')

@endsection
