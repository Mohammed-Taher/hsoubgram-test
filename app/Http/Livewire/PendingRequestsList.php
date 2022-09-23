<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PendingRequestsList extends Component
{
    public $pending_users_list;

    protected $listeners = ['refreshComponent' => '$refresh', 'follow_request_confirmed' => 'update_pending_users_list', 'follow_request_deleted' => 'update_pending_users_list'];


    public function update_pending_users_list()
    {
        $this->pending_users_list = [];
        $this->pending_users_list = auth()->user()->pendingFollowers;
    }


    public function render()
    {
        return view('livewire.pending-requests-list');
    }
}
