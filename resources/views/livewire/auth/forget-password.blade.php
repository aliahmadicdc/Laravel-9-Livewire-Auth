<div class="p-3 bg-light rounded text-right">
    <p class="text-center">{{trans('messages.forgetPasswordText')}}</p>
    <form wire:submit.prevent="submit">
        <div class="form-group">
            <label>{{trans('messages.phoneNumber')}}</label>
            <input inputmode="numeric" type="text" name="phone_number" class="form-control login-input"
                   placeholder="{{trans('messages.phoneNumberHint')}}"
                   wire:model.defer="data.phone_number">
            @error('data.phone_number')
            <p class="text-danger my-1 px-2">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit"
                    class="btn theme-btn full-width btn-m btn-submit">{{trans('messages.send')}}
                @include('livewire.include.loading',['loading_target'=>'submit'])
            </button>
        </div>
        <div class="mt-5">
            <span class="ml-2 full-width">{{trans('messages.haveAccount')}}</span>
            <a href="{{route('login')}}"
               class="btn btn-save btn-all full-width border-5">{{trans('messages.login')}}</a>
        </div>
    </form>
</div>
@section('meta_inner_js')
    @include('livewire.include.errorHandler')
@endsection
