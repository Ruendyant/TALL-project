<?php

namespace App\Http\Livewire;

use App\Models\Subscriber;
use Livewire\Component;

class Subsc extends Component
{
    public $search = "";

    protected $queryString = [
        'search' => ['except'=>'']
    ];

    public function delete(Subscriber $subs) {
        $subs->delete();
    }
    public function render()
    {
        $subscriber = Subscriber::where('email','like',"%{$this->search}%")->get();
        return view('livewire.subsc')->with([
            'subs' => $subscriber,
        ]);
    }
}
