<?php

namespace App\Http\Controllers\API;

use App\helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function all(Request $request)
    {

        $id = $request->input('id');
        $limit = $request->input('limit');
        $status = $request->input('status');

        if ($id) {

            $transaction = Transaction::with(['items.product'])->find($id);

            if ($transaction) {
                return ResponseFormatter::success($transaction, 'Transaction found');
            } else {
                return ResponseFormatter::error([], 'Transaction not found', 404);
            }
        }

        $transaction = Transaction::with(['items.product'])->where('users_id', Auth::user()->id);

        if ($status) {
            $transaction = $transaction->where('status', $status);
        }

        return ResponseFormatter::success($transaction->paginate($limit), 'Transactions found');
    }
}
