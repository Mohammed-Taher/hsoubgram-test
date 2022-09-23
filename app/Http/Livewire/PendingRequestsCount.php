<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PendingRequestsCount extends Component
{
    public $listeners = ['follow_request_confirmed' => 'get_pending_requests_count', 'follow_request_deleted' => 'get_pending_requests_count'];

    public function get_pending_requests_count()
    {
        return auth()->user()->pendingFollowers()->count();
    }

    public function render()
    {
        return view('livewire.pending-requests-count');
    }
}
