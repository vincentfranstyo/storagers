<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\History;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        // filter by user_id
        $user = Auth::user();
        $histories = History::all()->filter(function ($history) use ($user) {
            return $history->user_id == $user['id'];
        });

        return view('components/history', ['histories' => $histories]);
    }
}
