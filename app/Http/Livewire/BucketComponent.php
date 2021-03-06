<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Bucket;
use App\Models\Card;

class BucketComponent extends Component
{

    protected $listeners = ['cardMoved' => '$refresh'];

    public $bucket;
    public $bucketTitle;

    public function render()
    {
        $cards = $this->bucket->cards()->get();
        return view('livewire.bucket-component', ['bucket' => $this->bucket, 'cards' => $cards]);
    }

    public function mount()
    {
        $this->bucketTitle = $this->bucket->title;
    }

    public function deleteBucket()
    {
        $this->bucket->delete();
        $this->emit('bucketDeleted');
    }

    public function updateBucket()
    {
        $this->bucket->title = $this->bucketTitle;
        $this->bucket->save();
    }

    public function newCard()
    {
        $card = new Card();
        $card->title = "New Card";
        $card->description = "";
        $card->bucket_id = $this->bucket->id;
        $card->save();
    }
}
