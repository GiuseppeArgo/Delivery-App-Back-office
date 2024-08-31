<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BraintreeService;

class CheckoutController extends Controller
{
    // variable of braintree service
    protected $braintree;

    public function __construct(BraintreeService $braintree)
    {
        $this->braintree = $braintree;
    }

    public function generateToken() {

        $clientToken = $this->braintree->generateClientToken();

        $data = [
            'result' => $clientToken
        ];
        return response()->json($data);
    }

    public function makePayment(Request $request) {
        $nonce = $request->payment_method_nonce;
        $amount = $request->amount;

        $result = $this->braintree->gateway()->transaction()->sale([
            // transaction date
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,

            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        return response()->json($result);
    }

}
