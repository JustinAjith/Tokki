<?php

namespace App\Http\Controllers\User\Bid;

use App\Bid;
use App\Http\Requests\User\Bid\BidRequest;
use App\Repositories\User\BidRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BidController extends Controller
{
    protected $bid;
    public function __construct(BidRepository $bid)
    {
        $this->bid = $bid;
    }

    public function index(Request $request)
    {
        if(\request()->ajax()){
            return $this->bid->bidDataTable($request);
        }
        return view('user.bid.index');
    }

    public function create(): View
    {
        return view('user.bid.create');
    }

    public function store(BidRequest $request): RedirectResponse
    {
        $this->bid->store($request);
        return redirect()->back()->with('success', 'success');
    }

    public function show(Bid $bid)
    {
        if($bid->user_id == Auth::user()->id) {
            return view('user.bid.show', compact('bid'));
        } else {
            return redirect()->back()->with('autherror', 'autherror');
        }
    }
}
