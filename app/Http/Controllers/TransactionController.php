<?php

namespace App\Http\Controllers;

use App\Models\Funding;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function Fund(Request $request)
    {

        \Midtrans\Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = (bool) env('MIDTRANS_ISPRODUCTION');
        \Midtrans\Config::$is3ds = (bool) env('IS3DS');


        $auth = auth()->user();

        $user = User::find($auth->id);

        $funding =  Funding::find($request->funding_id);



        $orderId = 'T-' . time();
        $transaction_details = array(
            'order_id'    => $orderId,
            'gross_amount'  => $request->amount
        );; // Simpan perubahan

        $items = array(
            array(
                'id'       => 'fund-' . time(),
                'price'    => $request->amount,
                'quantity' => 1,
                'name'     => 'Funding '
            ),

        );


        $name = explode(' ', $user['name']);
        if (count($name) > 1) {
            $customer_details = array(
                'first_name'       => $name[0],
                'last_name'        => $name[1],
                'email'            => $user['email'],
                'phone'            => "08214124",

            );
        } else {
            $customer_details = array(
                'first_name'       => $name[0],
                'email'            => $user['email'],
                'phone'            => "08124124",

            );
        }

        $transaction = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $items,

        );


        $paymentUrl = \Midtrans\Snap::createTransaction($transaction);

        $payment = Payment::create([
            'service_name' => 'Snap Midtrans',
            'payment_code' =>  $orderId,
            'payment_url' =>   $paymentUrl->redirect_url,
            'service_id' => 'midtrans',


        ]);

        transaction::create([

            'user_id' => $auth->id,
            'payment_id' => $payment->id ,
            'amount' => $request->amount,
            'status' => false,
            'funding_id' =>  $funding->id,

        ]);




        return response()->json([
            'message' => 'Success',
            'data' => $paymentUrl], 200);
    }


    // webhook handler

    public function webHookHandler(Request $request) {

        $data = $request->all();


        $signatureKey = $data['signature_key'];
        $orderId = $data['order_id'];
        $statusCode = $data['status_code'];
        $grossAmount = $data['gross_amount'];
        $serverKey = env('MIDTRANS_SERVER_KEY');

        $mySignatureKey = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);
        $transactioStatus = $data['transaction_status'];
        $type = $data['payment_type'];
        $fraudStatus = $data['fraud_status'];

        if ($signatureKey !== $mySignatureKey) {
            return  response()->json([
                'message' => 'Invalid signature',
                'data' => $data
            ], 400);
        };

        $payment = Payment::where('payment_code', $orderId)->first();

        $transaction = transaction::where('payment_id', $payment->id)->first();

        if(!$payment) {

            return  response()->json([
                'message' => 'Payment not found',
                'data' => $data
            ], 400);
        }
        if ($payment->status === 1) {
            return response()->json([
                'message' => 'Payment already processed',
                'data' => $data
            ], 400);
        }

        if ($transactioStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                // TODO set transaction status on your database to 'challenge'
                $payment->status = 3;

                // and response with 200 OK
            } else if ($fraudStatus == 'accept') {
                // TODO set transaction status on your database to 'success'
                // and response with 200 OK
                $payment->status = 1;
            }
        } else if ($transactioStatus == 'settlement') {

            $transaction->status = 1;

            // funding

            $funding = Funding::find($transaction->funding_id);

            // add current_amoount

            $funding->current_amount = $funding->current_amount + $transaction->amount;

            // f
            $funding->status = 1;

            //save

            $funding->save();





            // update transaction

            $transaction->status = true;

        }
         else if (
            $transactioStatus == 'cancel' ||
            $transactioStatus == 'deny' ||
            $transactioStatus == 'expire'
        ) {
            // TODO set transaction status on your database to 'failure'
            $transaction->status = 3;






            // and response with 200 OK
        } else if ($transactioStatus == 'pending') {
            // TODO set transaction status on your database to 'pending' / waiting payment
            $transaction->status = 2;

        }


        $transaction->save();

        return true;

    }


    // get my transaction

    public function getMyTransaction(Request $request) {

        $auth = auth()->user();

        $transaction = transaction::where('user_id', $auth->id)->get();

        return response()->json([
            'message' => 'Success',
            'data' => $transaction
        ], 200);
    }


}
