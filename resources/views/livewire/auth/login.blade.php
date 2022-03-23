<div class="p-3 bg-light rounded text-right">
    <form wire:submit.prevent="submit">
        <div class="form-group">
            <label class="mr-1">{{trans('messages.phoneNumber')}}</label>
            <input inputmode="numeric" type="text" name="phone_number" class="form-control login-input"
                   placeholder="{{trans('messages.phoneNumberHint')}}" wire:model.defer="data.phone_number">
            @error('data.phone_number')
            <p class="text-danger my-1 px-2">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label class="mr-1">{{trans('messages.password')}}</label>
            <input type="password" name="password" class="form-control login-input" placeholder="*********"
                   id="password"
                   wire:model.defer="data.password">
            @error('data.password')
            <p class="text-danger my-1 px-2">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group text-center mt-2">
            <button type="submit"
                    class="btn theme-btn full-width btn-m btn-submit d-flex justify-content-center align-items-center">
                <span>{{trans('messages.login')}}</span>
                @include('livewire.include.loading',['loading_target'=>'submit'])
            </button>
        </div>
        <div class="mt-5">
            <span class="ml-2 text-center full-width">{{trans('messages.dontHaveAccount')}}</span>
            <a href="{{route('register')}}"
               class="btn btn-save btn-all full-width border-5">{{trans('messages.register')}}</a>
        </div>
        <div class="mt-5">
           <a href="{{route('forgotPassword')}}"
               class="btn btn-save btn-all full-width border-5">{{trans('messages.forgetPassword')}}</a>
        </div>
    </form>
</div>
@section('meta_inner_js')

@endsection
