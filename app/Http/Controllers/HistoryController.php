<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\History;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;


class HistoryController extends Controller
{
    use WithPagination;
    public function index()
    {
        // filter by user_id
        $user = Auth::user();
        $histories = History::where('user_id', $user->id)->paginate(5);

        return view('components/history', ['histories' => $histories]);
    }
}
