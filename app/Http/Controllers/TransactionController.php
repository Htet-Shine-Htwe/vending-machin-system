<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::query()
        ->when(!auth()->user()->hasRole(enum_value(RoleEnum::ADMIN)), function ($query) {
            return $query->where('user_id', auth()->id());
        })
        ->withCount('products')
        ->latest()->paginate(10);

        return view('portal.transaction.index',
            compact('transactions')
        );
    }
}
