<?php

namespace App\Repositories\Admin;

use App\Notification;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductRepository
{
    protected $product;
    protected $notification;
    public function __construct(Product $product = null, Notification $notification)
    {
        $this->product = $product ?? new Product();
        $this->notification = $notification ?? new Notification();
    }

    public function status(Product $product, $status)
    {
        $product->update(['status'=>$status]);
        // Add New Notification
        $notification = $this->notification;
        $notification->message = 'Your product status has been changed.';
        $notification->title = 'Response.';
        $notification->user_id = $product->user_id;
        $notification->admin_id = Auth::user()->id;
        $notification->admin_status = 0;
        $notification->save();
        return ['success'=>true];
    }

    // Admin permanently delete product
    public function delete($product)
    {
        $product = $this->product->onlyTrashed('id', $product)->first();
        $path = public_path('storage/product/');
        $images = json_decode($product->image);
        foreach($images as $image) {
            File::delete($path.$image);
        }
        File::delete(public_path('storage/display_image/').$product->display_image);
        $product->forceDelete();
    }
}