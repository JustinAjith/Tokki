<?php
namespace App\Repositories\Admin;

use App\Slider;
use Illuminate\Http\Request;

class SliderRepository
{
    protected $slider;
    public function __construct(Slider $slider = null)
    {
        $this->slider = $slider ?? new Slider();
    }

    public function store(Request $request)
    {
        $image = $request->file('image');
        $ext = $image->getClientOriginalExtension();
        $name = rand(00000000, 99999999).'.'.$ext;
        $image->move(public_path('images/slider'), $name);
        $slider = $this->slider->fill($request->toArray());
        $slider->setAttribute('image', $name);
        $slider->save();
    }

    public function status(Slider $slider)
    {
        $data = $this->slider->find($slider->id);
        if($slider->status == 'yes') {
            $data->update(['status'=>'no']);
        }
        if($slider->status == 'no') {
            $data->update(['status'=>'yes']);
        }
        return ['success'=>true];
    }
}