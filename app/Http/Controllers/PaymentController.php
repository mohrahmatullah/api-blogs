<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Transaction;
use App\Models\Merchant;
use App\Models\Wallet;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payment = Payment::where('payment.user_id',auth()->user()->id)
        ->select('payment.order_id','payment.price','t.description','t.status','m.name_merchant','m.chanel','c.success_url','c.cancel_url')
        ->join('transaction as t','t.payment_id','payment.id')
        ->join('merchant as m','m.id','t.merchant_id')
        ->leftjoin('callbacks as c','c.user_id','payment.user_id')
        ->orderBy('payment.created_at', 'DESC')->get();;
        return $payment;
    }

    public function store(Request $request)
    {
        try {
            $post = new Payment();
            $post->user_id          = auth()->user()->id;
            $post->order_id         = $request->order_id;
            $post->price            = $request->price;

            if ($post->save()) {

                $post1 = new Wallet;
                $post1->user_id = auth()->user()->id;
                $post1->currency_id = $request->currency_id;
                $post1->amount = $request->price;
                $post1->save();

                $post3= new Transaction;
                $post3->payment_id = $post->id;
                $post3->wallet_id = $post1->id;
                $post3->merchant_id = $request->merchant_id;
                $post3->description = $request->description;
                $post3->status = 'pending';
                $post3->save();

                return response()->json(['status' => 'success', 'message' => 'Payment successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function confirm_status(Request $request){
        $payment = Payment::where('order_id', $request->order_id)->first();
        $transaction = Transaction::where('payment_id',$payment->id)->first();
        $transaction->status = 'settlement';
        $transaction->confirms = 1;
        $transaction->save();

        return response()->json(['status' => 'success', 'message' => 'Confirm successfully']);
    }
}
