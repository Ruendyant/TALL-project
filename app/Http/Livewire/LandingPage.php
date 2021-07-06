<?php

namespace App\Http\Livewire;

use App\Models\Subscriber;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class LandingPage extends Component
{
    public $email;
    public $showSubs = false;
    public $showSucc = false;

    public function mount(Request $req) {
        if ($req->has('verified') && $req->verified==1) {
            $this->showSucc = true;
        };
    }

    protected $rules = [
        'email'=> "required|email:filter|unique:subscribers,email",
    ];

    public function subscribe()
    {
        $this->validate();

        DB::transaction(function () {
            $subscribe = Subscriber::create([
                'email'=>$this->email
            ]);

            $notification = new VerifyEmail;
            $notification->createUrlUsing(function($notifieable)
            {
                return URL::temporarySignedRoute(
                    'subscriber.verify',
                    now()->addMinutes(30),
                    [
                        'subscriber'=>$notifieable->id
                    ]
                );
            });
            $subscribe->notify($notification);
        }, $deadlockRestrides=5);

        $this->reset('email');
        $this->showSubs = false;
        $this->showSucc = false;
    }
    public function render()
    {
        return view('livewire.landing-page');
    }
}
