<?php
// app/Http/Controllers/MypageController.php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Sale;

class MypageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 中部：出品商品（商品番号＝id 昇順）
        $myProducts = Product::where('user_id', $user->id)
            ->orderBy('id', 'asc')
            ->get(['id', 'product_name', 'description', 'img_path', 'price']); // ← リネーム後の列

        // 下部：購入した商品（購入日昇順）＋必要な商品列だけ eager load
        $purchases = $user->sales()
            ->with(['product:id,product_name,description,price,img_path'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('mypage.index_view', compact('user', 'myProducts', 'purchases'));
    }

    public function purchases()
    {
        $user = Auth::user();

        $purchases = $user->sales()
            ->with(['product:id,product_name,description,price,img_path'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('mypage.purchases', compact('purchases'));
    }
}
