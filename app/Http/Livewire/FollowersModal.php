<?php

namespace App\Http\Livewire;

use LivewireUI\Modal\ModalComponent;

class FollowersModal extends ModalComponent
{
    public $followers_list;
    protected $listeners = ['refreshComponent' => '$refresh', 'follow_request_deleted' => 'update_followers_list'];


    public function update_followers_list()
    {
        $this->followers_list = [];
        $this->followers_list = auth()->user()->followers;
    }

    public function render()
    {
        return view('livewire.followers-modal');
    }
}
