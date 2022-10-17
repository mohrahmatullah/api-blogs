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
            $check_order = Payment::where('order_id',$request->order_id)->first();
            if($check_order){
                return response()->json(['status' => 'error', 'message' => 'order id can not be the same']);
            }
            else{
                $post = new Payment();
                $post->user_id          = auth()->user()->id;
                $post->order_id         = $request->order_id;
                $post->price            = $request->price;

                if ($post->save()) {

                    $Wallet = Wallet::where('user_id',auth()->user()->id)->exists();
                    if(!$Wallet){
                        $post1 = new Wallet;
                        $post1->user_id = auth()->user()->id;
                        $post1->currency_id = $request->currency_id;
                        $post1->save(); 
                    }
                    else{
                        $post_wallet = Wallet::where('user_id',auth()->user()->id)->first();
                    }

                    $post2= new Transaction;
                    $post2->payment_id = $post->id;
                    $post2->wallet_id = $post1->id ?? $post_wallet->id;
                    $post2->merchant_id = $request->merchant_id;
                    $post2->description = $request->description;
                    $post2->status = 'pending';
                    $post2->save();

                    return response()->json(['status' => 'success', 'message' => 'Payment successfully']);
                }                
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function confirm_status(Request $request){
        $payment = Payment::where('order_id', $request->order_id)->first();

        if($payment){            
            $transaction = Transaction::where('payment_id',$payment->id)->first();
            if($transaction->status == 'pending'){                
                $transaction->status = $request->confirms == 1 ? 'settlement':'cancelled';
                $transaction->confirms = $request->confirms;
                if($transaction->save()){
                    if($request->confirms == 1){
                        $post1_update = Wallet::where('user_id',auth()->user()->id)->first();
                        if($post1_update){
                            $post1_update->amount = $payment->price + $post1_update->amount;
                            $post1_update->save(); 
                        }
                        else{                    
                            $post1_update->amount = $payment->price;
                            $post1_update->save();
                        }
                    }
                }
            }
            else{
                return response()->json(['status' => 'error', 'message' => 'Not confirmed']);
            }

            return response()->json(['status' => 'success', 'message' => 'Confirm successfully']);            
        }

    }

    public function wallet(){
        $payment = Wallet::select('c.abbreviation as currency','wallet.amount')
        ->leftjoin('currency as c','c.id','wallet.currency_id')->where('wallet.user_id', auth()->user()->id)->first();

        return $payment;
    }
}
