<div class="p-3 bg-light rounded text-right">
    <form wire:submit.prevent="submit">
        <h3 class="text-center">{{$phone_number}}</h3>
        <p class="text-center">{{trans('messages.verifyText')}}</p>
        <div class="form-group">
            <label>{{trans('messages.code')}}</label>
            <input inputmode="numeric" type="text" name="phone_number" class="form-control login-input"
                   placeholder="{{trans('messages.code')}}"
                   wire:model.defer="data.verify_code">
            @error('data.verify_code')
            <p class="text-danger my-1 px-2">{{$message}}</p>
            @enderror
        </div>
        <input hidden wire:model.defer="phone_number" value="{{auth()->user()->phone_number}}">
        <div class="form-group">
            <button type="submit"
                    class="btn theme-btn full-width btn-m btn-submit">{{trans('messages.verifyPhoneNumber')}}
                @include('livewire.include.loading',['loading_target'=>'submit'])
            </button>
        </div>
        <div class="form-group">
            <button type="button" wire:click="resendCode"
                    class="btn theme-btn btn-m btn-back btn-all">{{trans('messages.sendAgain')}}</button>
        </div>
        <div class="mt-5">
            <span class="ml-2 text-center full-width">{{trans('messages.changePhoneNumber')}}</span>
            @livewire('auth.logout')
        </div>
    </form>
</div>
@section('meta_inner_js')

@endsection
