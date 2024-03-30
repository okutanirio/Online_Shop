<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ReviewRequest;
use Illuminate\Http\Request;

use App\product;
use App\type;
use App\productuser;
use App\like;
use App\Review;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function __construct(){
        $this->middleware('auth', ['only' => ['cart', 'cartlist']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        //一覧表示

        $searchWord = $request->input('searchWord');
        $category = $request->input('category');
        $minprice = $request->input('minprice');
        $maxprice = $request->input('maxprice');

        $query = product::query();

        $typename['name'] = '0';

        //商品名が入力された場合、productテーブルから一致する商品を$queryに代入
        if (isset($searchWord)) {
            $query->where('name', 'like', '%' . self::escapeLike($searchWord) . '%');
        }
        //カテゴリが選択された場合、m_categoriesテーブルからcategory_idが一致する商品を$queryに代入
        if (isset($category)) {
            $query->where('type_id', $category);
            $typename = product::select('types.name')->join('types', 'products.type_id', 'types.id')->where('products.type_id', '=', $category)->first()->toArray();
        }

        if(isset($minprice)) {
            $query->where('price', '>=', $minprice);
        }
        if(isset($maxprice)) {
            $query->where('price', '<=', $maxprice);
        }

        //$queryをcategory_idの昇順に並び替えて$productsに代入
        $products = $query->orderBy('created_at', 'desc')->paginate(10);

        //m_categoriesテーブルからgetLists();関数でcategory_nameとidを取得する
        $types = new type;
        $types = $types->getLists();

        return view('admins.product', [
            'typename' => $typename['name'], 
            'min' => $minprice, 
            'max' => $maxprice, 
            'products' => $products,
            'types' => $types,
            'category' => $category, 
            'searchWord' => $searchWord,
            'category' => $category, 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //登録表示
        $types = Type::get();

        return view('/admins/products.product_form', [
            'types' => $types, 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request) {
        //登録処理
        $product = new Product;        

        $product->name          = $request->name;
        $product->price         = $request->price;
        $product->stock         = $request->stock;
        $product->type_id       = $request->type_id;
        $product->info          = $request->info;
        $product->description   = $request->description;

        $dir = 'image';
        $file_name = date('Ymdhis'). '_' .$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/' . $dir, $file_name);
        $product->image = 'storage/' . $dir . '/' . $file_name;

        $product->save();

        return redirect()->route('products.index')->with('flash_message', '商品の登録が完了しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //詳細表示
        $like_model = new Like;

        $product = $product->find($product['id']);

        $types = Type::get();

        return view('/products/detail_product', [
            'like_model' => $like_model, 
            'id' => $product['id'], 
            'product' => $product, 
            'types' => $types, 
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        //編集ページの表示
        $result = $product->find($product['id']);
        $types = Type::get();

        return view('/admins/products.edit_product', [
            'id' => $result['id'], 
            'result' => $result, 
            'types' => $types, 
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product) {
        //編集処理
        $record = $product->find($product['id']);

        // 画像削除押下時
        if (isset($request->image_delete)) {
            $image = substr($record['image'], 14);
            Storage::disk('public')->delete('image/'. $image);

            $record->image = null;
            $record->save();
            return redirect()->route('products.edit', ['product' => $product['id']])->with('flash_message', '画像を削除しました。');
        }
        
        // 画像変更あり
        if (!isset($request->old_image)) {
            $image = substr($record['image'], 14);
            Storage::disk('public')->delete('image/'. $image);

            $dir = 'image';
            $file_name = date('Ymdhis'). '_' .$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/' . $dir, $file_name);
            $product->image = 'storage/' . $dir . '/' . $file_name;
            $record->image = $product->image;
        }

        $columns = ['name', 'price', 'stock', 'type_id', 'info','description'];

        foreach($columns as $column) {
            $record->$column = $request->$column;
        }

        $record->save();

        return redirect()->route('products.index')->with('flash_message', '商品の編集が完了しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //削除処理
        $image = substr($product['image'], 14);
        Storage::disk('public')->delete('image/'. $image);
        $product->where('id', $product['id'])->delete();
        return redirect()->route('products.index')->with('flash_message', '商品の削除が完了しました。');
    }

    // 管理者詳細ページ
    public function detail($id)
    {
        $product    = Product::find($id);
        $purchase   = productuser::where('product_id', $id)->count();

        return view('/admins/products.detail', compact('product', 'purchase'));
    }

    //////////////////////////////////////////////////////////////////
    // カート関連
    public function cart(Product $product)
    {
        $product = Product::find($product['id']);
        // 在庫確認
        if ($product->stock == 0) {
            return redirect()->route('products.show', $product['id'])->with('error_message', 'こちらの商品は在庫がありません。購入をご希望の場合はお問い合わせからご連絡ください。');
        } else {
            $product->stock = ($product->stock - 1);
            $product->save();
        }
        //カート処理 status0=カート status1=購入
        $productuser = new productuser;
        $userid = auth()->user()->id;

        $productuser->user_id = $userid;
        $productuser->product_id = $product['id'];
        $productuser->status = 0;
        $productuser->save();

        return redirect()->route('cart.list');
    }

    public function cartlist() {
        //カート処理 status0=カート status1=購入
        $productuser = new productuser;
        $product = new product;
        $userid = auth()->user()->id;

        $products = $product->all()->toArray();
        $productusers = $productuser->all()->toArray();

        $a = 0;
        foreach($products as $product) {
            foreach($productusers as $productuser) {
                if($userid == $productuser['user_id']) {
                    if($productuser['product_id'] == $product['id']) {
                        if($productuser['status'] == 0) {
                            $a = 1;
                        }
                    }
                }
            }
        }

        return view('/products/cartlist', [
            'a' => $a, 
            'productusers' => $productusers, 
            'products' => $products, 
            'userid' => $userid, 
        ]);
    }

    public function cartdelete($id)
    {
        $productuser    = productuser::find($id);
        $product        = Product::find($productuser->product_id);
        $product->stock++;
        $product->save();

        //削除処理
        $productuser->delete();
        return redirect()->route('cart.list')->with('flash_message', '商品の削除が完了しました。');
    }

    //////////////////////////////////////////////////////////////////
    // 購入関連
    public function orderconf() {
        
        $productuser = new productuser;
        $product = new product;
        $user = auth()->user();
        $product = $product->all()->toArray();
        $productuser = $productuser->all()->toArray();

        return view('/products/order_conf', [
            'productusers' => $productuser, 
            'products' => $product, 
            'user' => $user, 
        ]);
    }

    public function orderconp() {
        $productuser = productuser::where('user_id', Auth::user()->id)->get();
        foreach ($productuser as $value) {
            $product = Product::find($value->product_id);
            if ($product->stock == 0) {
                return redirect()->route('cart.list')->with('error_message', '商品名「'. $product->name .'」は在庫がありません。購入をご希望の場合はお問い合わせからご連絡ください。');
            }
        }
        productuser::where('user_id', Auth::user()->id)->update(['status' => 1]);

        return view('/products/order_conp');
    }

    //////////////////////////////////////////////////////////////////
    // カテゴリー関連
    public function pierce() {
        
        $product = new Product;

        $all = $product->where('type_id', '=', 1)->get();
        
        return view('/products/pierce', [
            'products' => $all, 
        ]);
    }
    public function necklace() {
        
        $product = new Product;

        $all = $product->where('type_id', '=', 2)->get();
        
        return view('/products/necklace', [
            'products' => $all, 
        ]);
    }
    public function ring() {
        
        $product = new Product;

        $all = $product->where('type_id', '=', 3)->get();
        
        return view('/products/ring', [
            'products' => $all, 
        ]);
    }
    public function bracelet() {
        
        $product = new Product;

        $all = $product->where('type_id', '=', 4)->get();
        
        return view('/products/bracelet', [
            'products' => $all, 
        ]);
    }
    
    // 商品検索
    public function result(request $request) {
        
        $searchWord = $request->input('searchWord');
        $category = $request->input('category');
        $minprice = $request->input('minprice');
        $maxprice = $request->input('maxprice');

        $query = product::query();

        $typename['name'] = '0';

        //商品名が入力された場合、productテーブルから一致する商品を$queryに代入
        if (isset($searchWord)) {
            $query->where('name', 'like', '%' . self::escapeLike($searchWord) . '%');
        }
        //カテゴリが選択された場合、m_categoriesテーブルからcategory_idが一致する商品を$queryに代入
        if (isset($category)) {
            $query->where('type_id', $category);
            $typename = product::select('types.name')->join('types', 'products.type_id', 'types.id')->where('products.type_id', '=', $category)->first()->toArray();
        }

        if(isset($minprice)) {
            $query->where('price', '>=', $minprice);
        }
        if(isset($maxprice)) {
            $query->where('price', '<=', $maxprice);
        }


        //$queryをcategory_idの昇順に並び替えて$productsに代入
        $products = $query->orderBy('id', 'asc')->paginate(10);

        //m_categoriesテーブルからgetLists();関数でcategory_nameとidを取得する
        $types = new type;
        $types = $types->getLists();

        return view('/products/search', [
            'typename' => $typename['name'], 
            'min' => $minprice, 
            'max' => $maxprice, 
            'products' => $products,
            'types' => $types,
            'category' => $category, 
            'searchWord' => $searchWord,
            'category' => $category, 
        ]);
    }

    //「\\」「%」「_」などの記号を文字としてエスケープさせる
    public static function escapeLike($str)
    {
        return str_replace(['\\', '%', '_'], ['\\\\', '\%', '\_'], $str);
    }

    // お気に入り機能
    public function ajaxlike(Request $request)  {
        $id = Auth::user()->id;
        $product_id = $request->product_id;
        $like = new Like;
        $product = Product::findOrFail($product_id);

        // 空でない（既にいいねしている）なら
        if ($like->like_exist($id, $product_id)) {
            //likesテーブルのレコードを削除
            $like = Like::where('product_id', $product_id)->where('user_id', $id)->delete();
        } else {
            //空（まだ「いいね」していない）ならlikesテーブルに新しいレコードを作成する
            $like = new Like;
            $like->product_id = $request->product_id;
            $like->user_id = Auth::user()->id;
            $like->save();
        }

        //loadCountとすればリレーションの数を○○_countという形で取得できる（今回の場合はいいねの総数）
        $productLikesCount = $product->loadCount('likes')->likes_count;

        //一つの変数にajaxに渡す値をまとめる
        //今回ぐらい少ない時は別にまとめなくてもいいけど一応。笑
        $json = [
            'productLikesCount' => $productLikesCount,
        ];
        //下記の記述でajaxに引数の値を返す
        return response()->json($json);
    }

    public function likelist() {
        //カート処理 status0=カート status1=購入
        $like = new like;
        $product = new product;
        $userid = auth()->user()->id;

        $products = $product->all()->toArray();
        $likes = $like->all()->toArray();

        $a = 0;
        foreach($products as $product) {
            foreach($likes as $like) {
                if($userid == $like['user_id']) {
                    if($like['product_id'] == $product['id']) {
                            $a = 1;
                        }
                    }
                }
            }

        return view('/products/likelist', [
            'a' => $a, 
            'likes' => $likes, 
            'products' => $products, 
            'userid' => $userid, 
        ]);
    }

    // レビュー関連
    public function review_send(ReviewRequest $request)  {
        $review = new Review();
        $review->product_id = $request->product_id;
        $review->name       = $request->name;
        $review->evaluation = $request->evaluation;
        $review->comment    = $request->comment ?? '';
        $review->save();

        return redirect()->back()->with('flash_message', 'レビューの投稿が完了しました。');
    }

    public function review_list($id)  {
        $reviews = Review::where('product_id', $id)->orderBy('created_at', 'DESC')->paginate(20);
        return view('products/review_list', compact('reviews'));
    }

}
