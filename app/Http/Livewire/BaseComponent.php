<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class BaseComponent extends Component
{
    use AuthorizesRequests;

    public $data;
    public string $livewire_error, $livewire_success;
    protected $paginationTheme = 'bootstrap';
    public bool $published = false;

    public function hydrate()
    {
        $this->resetParams();
        $this->resetValidation();
    }

    public function dehydrate()
    {
        $errorArray = [];

        if (isset($this->livewire_success))
            $errorArray['livewire_success'] = $this->livewire_success;

        if (isset($this->livewire_error))
            $errorArray['livewire_error'] = $this->livewire_error;

        $errorArray['errors'] = $this->getErrorBag();

        $this->dispatchBrowserEvent('errorHandler', $errorArray);
    }

    public function successResponse($route = 'panel.dashboard', $message = null, $params = null): void
    {
        if ($message) session()->flash('success', $message);

        $this->redirect(route($route, $params));
    }

    public function successBooleanResponse($message = null): bool
    {
        if ($message) session()->flash('success', $message);

        return true;
    }

    public function errorBooleanResponse($message = null): bool
    {
        if ($message) session()->flash('warning', $message);

        return false;
    }

    public function resetParams(): void
    {
        $this->livewire_error = '';
        $this->livewire_success = '';
    }

    public function resetData(): void
    {
        unset($this->data);
        $this->data = array();
    }
}
