<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Dish;
use App\User;
use App\Order;

class HomeController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //edit status
    public function editStatus($id)
    {
        // dd($id);
        $order = Order::findOrFail($id);
        $order->status = 'evaso';
        $order -> save();

        // dd($order);

        return redirect() -> back();

    }

    public function revertStatus($id)
    {
        // dd($id);
        $order = Order::findOrFail($id);
        $order->status = 'accettato';
        $order -> save();

        // dd($order);

        return redirect() -> back();

    }

    //creazione nuovo piatto
    public function createDish()
    {
        return view('pages.createDish');
    }


    //salvataggio in DB nuovo piatto
    public function storeDish(Request $request) {
        // dd($request -> all());

        $validated = $request -> validate([
            'nome' => 'required|string|min:3',
            'ingredienti' => 'required|string|min:3',
            'descrizione' => 'required|string|min:3',
            'prezzo' => 'required|between:0,9999.99',
            'visibilita' => 'required|boolean'

        ]);
        // dd($validated);

        $user = User::findOrFail($request->user()->id);
        // dd($user);

        $dish = Dish::make($validated);
        $dish -> user() -> associate($user);
        $dish -> save();

        return redirect() -> route('show', $user);
    }


    // modifica Piatto
    public function editDish($id) {

        $dish = Dish::findOrFail($id);

        return view('pages.editDish', compact('dish'));
    }

    public function updateDish(Request $request, $id)
    {
        // dd($request -> all());

        $validated = $request -> validate([
            'nome' => 'required|string|min:3',
            'ingredienti' => 'required|string|min:3',
            'descrizione' => 'required|string|min:3',
            'prezzo' => 'required|between:0,9999.99',
            'visibilita' => 'required|boolean'

        ]);

        $dish = Dish::findOrFail($id);
        $dish -> update($validated);

        $dish -> save();
        $user = User::findOrFail($request->user()->id);

        return redirect() -> route('show', $user);
    }

    //eliminazione Piatto
    public function destroy($id, $userid) {
        // dd($id, $userid);
        $dish = Dish::findOrFail($id);
        //$dish -> delete();

        $user = $userid;
        $dish -> deleted = true;
        $dish -> save();


        return redirect() -> route('show', $user);
    }


    //mostra ordini
    public function showOrders($id)
    {
        $user = User::findOrFail($id);
        $orders = Order::orderBy('created_at', 'DESC')
          ->get();
        //dd($orders);



        $ordersId = array();
        $orderSel = array();


        //pusha in array i piatti di un ristorante
        foreach ($user -> dishes as $dish) {
            foreach ($dish -> orders as $order){
                if (!in_array($order->id, $ordersId)) {
                    array_push($ordersId, $order->id);
                }
            }
        }

        foreach ($ordersId as $orderId) {
            $selectedOrder = Order::findOrFail($orderId);
            array_push($orderSel, $selectedOrder);
        }

        // dd($orderCount);
        return view('pages.showOrders', compact('user', 'orderSel'));
    }

    //get Statistica
    public function statistiche($id){

        $myUser = User::FindOrFail($id);

        $user = DB::table('users')
        ->join('dishes', 'users.id', '=', 'dishes.user_id')
        ->where('users.id', $myUser -> id)
        ->join('dish_order', 'dishes.id', '=', 'dish_order.dish_id')
        ->join('orders', 'orders.id', '=', 'dish_order.order_id')
        ->get();


        // dd($user);
        return view('pages.statistiche', compact('user'));
    }




    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */

}
