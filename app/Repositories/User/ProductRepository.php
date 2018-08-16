<?php
namespace App\Repositories\User;

use App\Bid;
use App\BidRang;
use App\Http\Requests\User\Product\Create\ProductRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class ProductRepository
{
    protected $product;
    protected $bidRang;
    public function __construct(Product $product = null, BidRang $bidRang = null)
    {
        $this->product = $product ?? new Product();
        $this->bidRang = $bidRang ?? new BidRang();
    }

    public function getProducts()
    {
        return $this->product->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(20);
    }

    //  New Product Save in Data Base
    public function store(ProductRequest $request)
    {
        $imageName = $this->image($request->image);
        $bid = $this->bid($request->price);
        $product = $this->product;
        $product->user_id = Auth::user()->id;
        $product->code = $request->code;
        $product->category = $request->category;
        $product->sub_category = $request->sub_category;
        $product->mini_category = $request->mini_category;
        $product->heading = $request->heading;
        $product->key_word = $request->key_word;
        $product->discount_type = $request->discount_type;
        $product->discount = $request->discount;
        $product->price = $request->price;
        $product->qty = $request->qty;
        $product->delivery_places = json_encode($request->delivery_places);
        $product->image = json_encode($imageName);
        $product->title = json_encode($request->title);
        $product->description = json_encode($request->description);
        $product->features = json_encode($request->features);
        $product->features_description = json_encode($request->features_description);
        $product->bid_rand = $bid;
        $product->save();
        return ['success'=>true];
    }

    // Image Resize and Move to Storage folder
    public function image($images)
    {
        $name = array();
        foreach($images as $key => $image) {
            $ext = $image->getClientOriginalExtension();
            $img = Image::make($image)->resize(400, 500, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $img->resizeCanvas(400, 500, 'center', false, array(255, 255, 255, 0));
            $rend = rand(00000000, 99999999).'-'.Auth::user()->id;
            $productName = $rend.'.'.$ext;
            $img->save(public_path('storage/product/'.$productName));
            $name[] = $productName;
        }
        return $name;
    }

    //  Give bid value to create product.
    public function bid($price)
    {
        $bidRand = $this->bidRang->all();
        foreach($bidRand as $key => $value) {
            if($price >= $value->from && $price <= $value->to) {
                $bid = $value->bid;
            }
        }
        return $bid;
    }

    // Remove Product
    public function delete(Product $product)
    {
        $product->delete();
        return ['success'=>true];
    }

    public function generalDetails(Request $request, Product $product)
    {
        $product = $this->product->find($product->id);
        $product->code = $request->code;
        $product->heading = $request->heading;
        $product->key_word = $request->key_word;
        $product->qty = $request->qty;
        $product->delivery_places = json_encode($request->delivery_places);
        $product->status = 'Pending';
        $product->save();
        return ['success'=> true];
    }

    public function productDetails(Request $request, Product $product)
    {
        $product = $this->product->find($product->id);
        $product->title = json_encode($request->title);
        $product->description = json_encode($request->description);
        $product->status = 'Pending';
        $product->save();
        return ['success'=> true];
    }

    public function productImageDelete($image, Product $product)
    {
        $images = json_decode($product->image);
        $nwImages = array();
        foreach($images as $oldImage) {
            if($oldImage !== $image) {
                array_push($nwImages, $oldImage);
            }
        }
        $product = $this->product->find($product->id);
        $product->image = json_encode($nwImages);
        $product->status = 'Pending';
        $product->save();
        return ['success'=> true];
    }

    public function productImage(Request $request, Product $product)
    {
        $images = json_decode($product->image);
        $requestImages = $this->image($request->image);
        foreach($requestImages as $requestImage) {
            array_push($images, $requestImage);
        }
        $product = $this->product->find($product->id);
        $product->image = json_encode($images);
        $product->status = 'Pending';
        $product->save();
        return ['success'=> true];
    }

    public function productSpecialFeatures(Request $request, Product $product)
    {
        $product = $this->product->find($product->id);
        $product->features = json_encode($request->features);
        $product->features_description = json_encode($request->features_description);
        $product->status = 'Pending';
        $product->save();
        return ['success'=> true];
    }

    public function productPrice(Request $request, Product $product)
    {
        $bid = $this->bid($request->price);
        $product = $this->product->find($product->id);
        $product->discount_type = $request->discount_type;
        $product->discount = $request->discount;
        $product->price = $request->price;
        $product->bid_rand = $bid;
        $product->save();
        return ['success'=> true];
    }
}