<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Repositories\Admin\SliderRepository;
use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    protected $slider;
    public function __construct(SliderRepository $slider)
    {
        $this->slider = $slider;
    }

    public function index()
    {
        $sliders = Slider::all();
        return view('admin.setting.slider.index', compact('sliders'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required'
        ]);
        $this->slider->store($request);
        return redirect()->back()->with('success', 'success');
    }

    public function delete(Slider $slider)
    {
        $slider->delete();
        return ['success'=>true];
    }

    public function status(Slider $slider)
    {
        $this->slider->status($slider);
        return ['success'=>true];
    }
}
