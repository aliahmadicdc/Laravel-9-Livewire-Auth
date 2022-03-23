<div class="p-3 bg-light rounded text-right">
    <form wire:submit.prevent="submit">
        <h3 class="text-center mt-2">{{$phone_number}}</h3>
        <div class="form-group">
            <label>{{trans('messages.newPassword')}}</label>
            <input type="password" name="password" class="form-control login-input" id="password"
                   wire:model.defer="data.password" placeholder="*********">
            @error('data.password')
            <p class="text-danger my-1 px-2">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label>{{trans('messages.newPasswordConfirm')}}</label>
            <input type="password" name="password" class="form-control login-input" id="password"
                   wire:model.defer="data.password_confirmation" placeholder="*********">
            @error('data.password_confirmation')
            <p class="text-danger my-1 px-2">{{$message}}</p>
            @enderror
        </div>
        <input hidden name="phone_number" wire:model.defer="phone_number" value="{{$phone_number}}">
        <input hidden name="token" wire:model.defer="token" value="{{$token}}">
        <div class="form-group">
            <button type="submit"
                    class="btn theme-btn full-width btn-m btn-submit">{{trans('messages.change')}}
                @include('livewire.include.loading',['loading_target'=>'submit'])
            </button>
        </div>
    </form>
</div>
@section('meta_inner_js')

@endsection
