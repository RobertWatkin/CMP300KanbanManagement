<?php

namespace App\Http\Livewire;

use App\Models\Board;
use App\Models\BoardMember;
use App\Models\CardMember;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Route;


class CardAssignment extends Component
{

    public $assignedtocard;
    public $members;
    public $board;
    public $card;
    public $dataLoaded = false;

    public function render()
    {
        // only allow assignment of editors and admins
        $boardmembers = BoardMember::where(['board_id' => $this->board->id])->where('role', '!=', 'Viewer')->get();

        // create arrays
        if (!is_array($this->members)) {
            $this->members = array();
        }

        if (!is_array($this->assignedtocard)) {
            $this->assignedtocard = array();
        }

        // check if on the edit page
        if (Route::currentRouteName() == "card.edit" && $this->dataLoaded == false) {
            // loop through all card members currently on the account

            foreach ($this->card->cardMembers as $currentlyAssigned) {
                // add the user to the assigned list
                $user = $currentlyAssigned->user()->first();
                array_push($this->assignedtocard, $user);
            }

            $dataLoaded = true;
        }


        $counter = 0;
        foreach ($boardmembers as $member) {
            // check if the member has already been added to the selection list
            if (in_array($member->user()->first(), $this->members)) {
                continue;
            }

            // check if the member has already been added to the card
            foreach ($this->assignedtocard as $user) {
                if ($user->id == $member->user_id) {
                    continue 2;
                }
            }

            $counter++;

            $user = $member->user()->first();
            array_push($this->members, $user);
        }

        return view('livewire.card-assignment', ['assignedtocard' => $this->assignedtocard, 'members' => $this->members]);
    }


    public function removeUser($id)
    {
        $this->resetObject();


        array_push($this->members, $this->assignedtocard[$id]);
        unset($this->assignedtocard[$id]);
    }

    public function assignUser($id)
    {
        $this->resetObject();


        array_push($this->assignedtocard, $this->members[$id]);
        unset($this->members[$id]);
    }

    public function resetObject()
    {
        // laravel converts the eloquent objects to normal arrays for some unknown reason on the action call so setting them back to laravel objects https://github.com/livewire/livewire/issues/27
        $temp = $this->members;
        $this->members = array();

        foreach ($temp as $member) {
            $user = User::where(['id' => $member['id']])->first();
            array_push($this->members, $user);
        }

        // same for assigned to card 
        $temp = $this->assignedtocard;
        $this->assignedtocard = array();

        foreach ($temp as $member) {
            $user = User::where(['id' => $member['id']])->first();
            array_push($this->assignedtocard, $user);
        }
    }
}
