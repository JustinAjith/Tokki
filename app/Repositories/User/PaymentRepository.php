<?php
namespace App\Repositories\User;

use App\Http\Requests\User\Payment\PaymentRequest;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentRepository
{
    protected $payment;
    public function __construct(Payment $payment = null)
    {
        $this->payment = $payment ?? new Payment();
    }

    public function store(PaymentRequest $request)
    {
        $request->merge(['user_id'=>Auth::user()->id]);
        $payment = $this->payment->fill($request->toArray());
        $payment->setAttribute($request->payment, $request->amount);
        $payment->save();
    }

    public function statementResult(Request $request)
    {
        $payments = $this->payment::where('user_id', Auth::user()->id)->whereBetween('date', [$request->start, $request->end])->get();
        return $payments;
    }
}