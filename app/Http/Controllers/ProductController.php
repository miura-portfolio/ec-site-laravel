<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductIndexRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only([
            'index','show','create','store','edit','update','toggleLike','ownerShow','destroy'
        ]);
    }

    public function index(ProductIndexRequest $request)
    {
        $q = Product::query();

        $v = $request->validated();
        if (!empty($v['name'])) {
            $q->where('product_name', 'like', '%'.$v['name'].'%');
        }
        if (isset($v['min_price'])) {
            $q->where('price', '>=', $v['min_price']);
        }
        if (isset($v['max_price'])) {
            $q->where('price', '<=', $v['max_price']);
        }

        $products = $q->get();
        return view('products.list_view', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with('company')->findOrFail($id);

        $user = auth()->user();
        $isLiked = $user ? $user->likedProducts()->where('product_id', $id)->exists() : false;

        return view('products.detail_view', compact('product','isLiked'));
    }

    public function create()
    {
        return view('products.create_view');
    }

    public function store(ProductStoreRequest $request)
    {
        $v = $request->validated();

        $company = Company::firstOrCreate(['company_name' => trim($v['company_name'])]);

        $imagePathForView = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $imagePathForView = 'storage/'.$path;
        }

        Product::create([
            'product_name' => $v['name'],
            'description'  => $v['description'] ?? '',
            'price'        => $v['price'],
            'stock'        => $v['stock'],
            'img_path'     => $imagePathForView,
            'company_id'   => $company->id,
            'user_id'      => Auth::id(),
        ]);

        return redirect()->route('mypage.index')->with('success','商品を登録しました');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit_view', compact('product'));
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $v = $request->validated();

        $data = [
            'product_name' => $v['name'],
            'description'  => $v['description'] ?? '',
            'price'        => $v['price'],
            'stock'        => $v['stock'],
        ];

        if ($request->boolean('remove_image') && !empty($product->img_path)) {
            $publicPath = preg_replace('#^storage/#', '', $product->img_path);
            if ($publicPath) Storage::disk('public')->delete($publicPath);
            $data['img_path'] = null;
        }

        if ($request->hasFile('image')) {
            if (!empty($product->img_path)) {
                $publicPath = preg_replace('#^storage/#', '', $product->img_path);
                if ($publicPath) Storage::disk('public')->delete($publicPath);
            }
            $path = $request->file('image')->store('products', 'public');
            $data['img_path'] = 'storage/'.$path;
        }

        if (isset($v['company_name'])) {
            $name = trim($v['company_name']);
            if ($name !== '') {
                $company = Company::firstOrCreate(['company_name' => $name]);
                $data['company_id'] = $company->id;
            }
        }

        $product->update($data);

        return redirect()->route('mypage.index')->with('success','商品を更新しました');
    }

    // 以下はバリデ不要
    public function toggleLike($id)
    {
        $user = auth()->user();
        $product = Product::findOrFail($id);

        if ($user->likedProducts()->where('product_id', $id)->exists()) {
            $user->likedProducts()->detach($product->id);
        } else {
            $user->likedProducts()->attach($product->id);
        }
        return back();
    }

    public function ownerShow($id)
    {
        $product = Product::with('company')->findOrFail($id);
        if ($product->user_id !== auth()->id()) abort(Response::HTTP_FORBIDDEN);
        return view('products.owner_detail_view', compact('product'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->user_id !== auth()->id()) abort(Response::HTTP_FORBIDDEN);

        if (!empty($product->img_path)) {
            $publicPath = preg_replace('#^storage/#', '', $product->img_path);
            if ($publicPath) Storage::disk('public')->delete($publicPath);
        }

        $product->delete();
        return redirect()->route('mypage.index')->with('success','商品を出品停止にしました');
    }
}
