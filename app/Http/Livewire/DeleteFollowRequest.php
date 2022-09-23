<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class DeleteFollowRequest extends Component
{
    private $pending_request_user;
    public $user_id;

    public function delete($user_id)
    {
        $this->pending_request_user = User::find($user_id);
        auth()->user()->delete_follow_request($this->pending_request_user);
        $this->emit('follow_request_deleted');
        $this->emitTo('pending-request-list', 'refreshComponent');
        $this->emitTo('followers-modal', 'refreshComponent');
        $this->emitTo('following-modal', 'refreshComponent');
    }

    public function render()
    {
        return view('livewire.delete-follow-request');
    }
}
