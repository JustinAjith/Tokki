<?php

namespace App\Http\Controllers\User\Payment;

use App\Http\Requests\User\Payment\PaymentRequest;
use App\Repositories\User\PaymentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    protected $payment;
    public function __construct(PaymentRepository $payment)
    {
        $this->payment = $payment;
    }

    public function statement()
    {
        return view('user.payment.statement');
    }

    public function create()
    {
        return view('user.payment.create');
    }

    public function store(PaymentRequest $request)
    {
        $this->payment->store($request);
        return redirect()->back()->with('success', 'success');
    }

    public function statementResult(Request $request)
    {
        $payments = $this->payment->statementResult($request);
        return response()->json($payments);
    }
}
