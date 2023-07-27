<?php

namespace App\Http\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Tymon\JWTAuth\Facades\JWTAuth;

class Verify extends Component
{
    public function resend()
    {
        if (Auth::User()->hasVerifiedEmail()) {
            redirect(route('home'));
        }

        Auth::User()->sendEmailVerificationNotification();

        $this->emit('resent');

        session()->flash('resent');
    }

    public function render()
    {
        return view('livewire.auth.verify')->extends('layouts.auth');
    }
}
