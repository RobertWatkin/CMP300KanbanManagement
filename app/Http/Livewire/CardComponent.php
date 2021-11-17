<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CardComponent extends Component
{
    public $card;

    public function render()
    {
        $links = $this->card->cardMembers()->get();
        $users = array();
        foreach ($links as $link) {
            $user = $link->user()->get();
            array_push($users, $user[0]);
        }

        return view('livewire.card-component', ['bucketid' => $this->card->bucket_id, 'card' => $this->card, 'assigned' => $users]);
    }
}
