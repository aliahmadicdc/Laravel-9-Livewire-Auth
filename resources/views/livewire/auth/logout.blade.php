<button class="btn btn-danger" wire:click="logout">{{trans('messages.logout')}}
    @include('livewire.include.loading',['loading_target'=>'logout'])
</button>
