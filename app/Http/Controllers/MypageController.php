<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Sale;

/**
 * マイページ（出品一覧／購入履歴）
 * 主要ルート: /mypage, /mypage/purchases
 */
class MypageController extends Controller
{
    /** マイページトップ：出品商品＋購入履歴のサマリ */
    public function index()
    {
        $user = Auth::user();

        // 出品商品（id昇順）
        $myProducts = Product::where('user_id', $user->id)
            ->orderBy('id', 'asc')
            ->get(['id', 'product_name', 'description', 'img_path', 'price']);

        // 購入履歴（商品は必要な列だけ eager load）
        $purchases = $user->sales()
            ->with(['product:id,product_name,description,price,img_path'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('mypage.index_view', compact('user', 'myProducts', 'purchases'));
    }

    /** 購入履歴詳細 */
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
