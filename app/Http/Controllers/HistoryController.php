<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\History;
use App\Models\User;

class HistoryController extends Controller
{
    public function index(User $user)
    {
        // filter by user_id
        $histories = History::all()->filter(function ($history) use ($user) {
            return $history->user_id == $user->id;
        });

        return view('components/history', ['histories' => $histories]);
    }
}
