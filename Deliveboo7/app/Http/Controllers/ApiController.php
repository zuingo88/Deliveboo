<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Type;
use App\Order;

class ApiController extends Controller
{

    public function getCategories(){
        $categories = Type::all();
        json_encode($categories);
        return $categories;
    }

    // public function getRestaurants()
    // {
    //     $restaurants = User::all();
    //
    //     return [$restaurants];
    //
    // }
    public function getAllRestaurants(){

        $restaurants = User::all();

        $category_restaurant = [];

        foreach ($restaurants as $restaurant) {
            $query = DB::table('type_user')
                                -> join('types', 'type_user.type_id', '=', 'types.id')
                                -> select('type_user.user_id as res_id','types.id', 'types.nome')
                                -> where('type_user.user_id', $restaurant -> id)
                                -> get();

            array_push($category_restaurant, $query);
        }

        return [$restaurants, $category_restaurant];

    }



}
