<?php namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller {

    public function __construct()
    {

    }

    public function filter(Request $request)
    {
        $data = $request->get('categories');
        if (!is_array($data)) {
            return response()->json(['Array expected'], 422);
        }
        if (empty($data)) {
            $response = Item::orderBy('current_price','ASC')->get();
        } else {
            $response = Item::whereIn('category_id', $data)->orderBy('current_price','ASC')->get();
        }
        $response->map(function ($item) {
            return $item->safe();
        });
        return response()->json($response->toArray(), 200);
    }

}