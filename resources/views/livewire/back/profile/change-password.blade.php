<form class="dash-profile-form col-md-12" wire:submit.prevent="update">
    <div class="tr-single-box">
        <div class="tr-single-header d-flex justify-content-between align-items-center">
            <h3 class="profile-title"><i class="ti-pencil-alt pl-1"></i>{{trans('messages.changePassword')}}</h3>
            <div class="btn-group fl-right">
                <button type="submit" class="btn btn-md btn-save btn-all">{{trans('messages.save')}}
                    @include('livewire.include.loading',['loading_target'=>'update'])
                </button>
            </div>
        </div>
        <div class="tr-single-body">
            <div class="form-row mt-4">
                <div class="form-group form-group-sm col-md-6">
                    <label class="mr-1" for="password">{{trans('messages.password')}}</label>
                    <input class="form-control form-control-sm" type="password" id="password"
                           wire:model="data.old_password" placeholder="{{trans('messages.password')}}">
                    @error('data.old_password')
                    <p class=" text-danger my-1 px-2">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group form-group-sm col-md-6">
                    <label class="mr-1" for="new-password">{{trans('messages.newPassword')}}</label>
                    <input class="form-control form-control-sm" type="password" id="new-password"
                           wire:model="data.password" placeholder="{{trans('messages.newPassword')}}">
                    @error('data.password')
                    <p class=" text-danger my-1 px-2">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group form-group-sm col-md-6">
                    <label class="ml-1" for="repeat-password">{{trans('messages.newPasswordConfirm')}}</label>
                    <input class="form-control form-control-sm" type="password" id="repeat-password"
                           wire:model="data.password_confirmation"
                           placeholder="{{trans('messages.newPasswordConfirm')}}">
                    @error('data.password_confirmation')
                    <p class=" text-danger my-1 px-2">{{$message}}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>


</form>
