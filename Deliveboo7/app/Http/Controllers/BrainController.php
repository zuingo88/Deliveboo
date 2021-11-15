<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Mail\NewOrder;
use App\Mail\NewOrderUser;
use App\Order;


class BrainController extends Controller
{
    public function pay($order)
    {
        // dd($totalPrice);
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.enviroment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $token = $gateway->ClientToken()->generate();
        // dd($order);
        $editableOrder = Order::findOrFail($order);
        $orderPrice = $editableOrder->totalPrice;
        // dd($orderPrice);
        return view('pages.braintree', compact('token','order', 'orderPrice'));
    }

    public function checkout(Request $request, $order)
    {
        // dd($order);
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.enviroment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $editableOrder = Order::findOrFail($order);
        // dd($editableOrder);

        $amount = $editableOrder->totalPrice;
        $nonce = $request -> payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);


        $users = DB::table('orders')
        ->join('dish_order', 'orders.id', '=', 'dish_order.order_id')
        ->where('orders.id', $editableOrder -> id)
        ->join('dishes', 'dishes.id', '=', 'dish_order.dish_id')
        ->join('users', 'dishes.user_id', '=', 'users.id')
        ->get();
        // dd($users[0]);

        if ($result->success) {
            $transaction = $result->transaction;
            // header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);

            $editableOrder->status = 'accettato';
            $editableOrder -> save();


            // dd($users[0]);
            Mail::to($users[0]->email)
            ->send(new NewOrder($editableOrder, $users[0]->name));

            Mail::to($editableOrder->email_cliente)
            ->send(new NewOrderUser($editableOrder, $users[0]->nome_attivita));

            return view('pages.paymentDetails', compact('amount', 'editableOrder'));
        } else {
            $editableOrder->status = 'rifiutato';
            $editableOrder -> save();

            $errorString = "";

            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            };

            // $_SESSION["errors"] = $errorString;
            // header("Location: " . $baseUrl . "index.php");
            return view('pages.paymentDetails', compact('amount', 'editableOrder'));

        }
    }

    public function paymentDetails()
    {
        return view('pages.paymentDetails');

    }
}
