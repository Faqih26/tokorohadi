<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Transaction;
use App\Models\TransactionDetail;

class DashboardController extends Controller
{
    public function index()
    {
        $customer = User::count();
        $revenue = Transaction::where('transaction_status','SUCCESS')->sum('total_price');
        $transaction = Transaction::count();

        $transactions = TransactionDetail::with(['transaction.user','product.galleries'])
                        ->whereHas('product',function($product){
                            $product->where('users_id',Auth::user()->id);
                        })->take(10)
                        ->latest();

        return view('pages.admin.dashboard',[
            'customer' => $customer,
            'revenue' => $revenue,
            'transaction' => $transaction,
            'transaction_data' => $transactions->get(),
        ]);
    }

}
