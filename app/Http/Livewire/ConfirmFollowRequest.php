<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class ConfirmFollowRequest extends Component
{
    private User $pending_request_user;
    public $user_id;


    public function confirm($user_id)
    {
        $this->pending_request_user = User::find($user_id);
        auth()->user()->confirm_follow_request($this->pending_request_user);
        $this->emit('follow_request_confirmed');
        $this->emitTo('pending-requests-list', 'refreshComponent');
    }

    public function render()
    {
        return view('livewire.confirm-follow-request');
    }
}
