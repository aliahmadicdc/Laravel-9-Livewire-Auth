<form class="dash-profile-form col-md-12" wire:submit.prevent="update">
    <div class="tr-single-box">
        <div class="tr-single-header d-flex justify-content-between align-items-center">
            <h3 class="profile-title"><i class="ti-pencil-alt pl-1"></i>{{trans('messages.basic')}}</h3>
            <div class="btn-group fl-right">
                <button type="submit" class="btn btn-md btn-save btn-all">{{trans('messages.save')}}
                    @include('livewire.include.loading',['loading_target'=>'update'])
                </button>
            </div>
        </div>
        <div class="tr-single-body">
            <div class="form-group form-group-sm d-flex mx-auto">
                <div class="ds-avatar-thumb relative">
                    <img width="100" height="100"
                        src="@if(isset($data['image'])) {{$data['image']->temporaryUrl()}} @elseif($user->image){{$user->image->name}}@else{{asset('assets/img/profile.png')}}@endif"
                        class="img-responsive-2 pointer" alt="">
                </div>
                @error('data.image')
                <p class="text-danger my-1 px-2">{{$message}}</p>
                @enderror
            </div>
            <input class="form-control form-control-sm" type="file" id="img" wire:model.defer="data.image">
            <div class="form-row mt-5">
                <div class="form-group form-group-sm col-md-6">
                    <label class="mr-1" for="name">{{trans('messages.name2')}}</label>
                    <input type="text" class="form-control form-control-sm" id="name" wire:model="data.name"
                           placeholder="{{trans('messages.name2')}}">
                    @error('data.name')
                    <p class="text-danger my-1 px-2">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group form-group-sm col-md-6">
                    <label class="mr-1" for="email">{{trans('messages.email')}}</label>
                    <input type="email" class="form-control form-control-sm" id="email" wire:model="data.email"
                           placeholder="{{trans('messages.email')}}">
                    @if($user->email!=null && $user->email_verified_at==null)
                        <a class="btn btn-md btn-save btn-all m-2" style="color: white"
                           wire:click="verifyEmail">{{trans('messages.verifyEmail')}}</a>
                    @endif
                    @error('data.email')
                    <p class=" text-danger my-1 px-2">{{$message}}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</form>
