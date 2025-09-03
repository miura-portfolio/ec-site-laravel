<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Http\Requests\PurchaseRequest;
use App\Models\Product;
use App\Models\Sale;

class PurchaseController extends Controller
{
    public function showForm($id)
    {
        $product = Product::with('company')->findOrFail($id);
        $ptoken  = (string) Str::uuid();

        return view('purchase.form_view', [
            'product' => $product,
            'ptoken'  => $ptoken,
        ]);
    }

    public function store(PurchaseRequest $request, $id)
    {
        $qty    = (int) $request->input('quantity', 1);
        $userId = Auth::id();
        $ptoken = $request->input('ptoken');

        $cacheKey = 'purchase:token:'.$ptoken;
        if (! Cache::add($cacheKey, true, 60)) {
            return back()->withErrors(['purchase' => '同じ購入を重複送信した可能性があります。もう一度お試しください。'])->withInput();
        }

        try {
            DB::transaction(function () use ($id, $qty, $userId) {
                $product = Product::where('id', $id)->lockForUpdate()->firstOrFail();

                if ($product->stock < $qty) throw new \RuntimeException('在庫が不足しています。');

                $product->decrement('stock', $qty);

                Sale::create([
                    'user_id'           => $userId,
                    'product_id'        => $product->id,
                    'quantity'          => $qty,
                    'price_at_purchase' => $product->price,
                ]);
            });
        } catch (\Throwable $e) {
            report($e);
            return back()->withErrors(['purchase' => $e->getMessage() ?: '購入処理に失敗しました。もう一度お試しください。'])->withInput();
        }

        return redirect()->route('product.list')->with('success', '購入が完了しました！');
    }
}
