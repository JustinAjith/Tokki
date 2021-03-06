<?php

namespace App\Http\Controllers\Admin\Bid;

use App\Bid;
use App\BidRang;
use App\Http\Requests\Admin\Bid\BidRangRequest;
use App\Repositories\Admin\BidRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        return view('admin.bid.index');
    }

    public function show(Bid $bid): View
    {
        $userBid = $bid;
        return view('admin.bid.show', compact('userBid'));
    }

    public function bidAccept(Bid $bid)
    {
        return $this->bid->bidAccept($bid);
    }

    public function bidReject(Bid $bid)
    {
        return $this->bid->bidReject($bid);
    }

    public function bidRang(Request $request)
    {
        if(\request()->ajax()) {
            return $this->bid->bidRang($request);
        }
        return view('admin.bid.bid_rang');
    }

    public function create(): View
    {
        return view('admin.bid.bid_rang_create');
    }

    public function store(BidRangRequest $request): RedirectResponse
    {
        $this->bid->store($request);
        return redirect()->back()->with('success', 'success');
    }

    public function edit(BidRang $bid)
    {
        return view('admin.bid.bid_rang_edit', $bid);
    }

    public function update(BidRangRequest $request, BidRang $bid): RedirectResponse
    {
        $this->bid->update($request, $bid);
        return redirect()->back()->with('success', 'success');
    }
}
