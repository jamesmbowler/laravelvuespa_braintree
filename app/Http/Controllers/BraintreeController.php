<?php
namespace App\Http\Controllers;

use App\Enums\PaymentType;
use App\Models\Subscriptions;
use Braintree\Exception;
use Illuminate\Http\Request;
use Braintree\Gateway;
use Braintree\Result\Error;

class BraintreeController extends Controller
{
    private Gateway $gateway;

    public function clientToken() {
        return response()->json(
            ['token'=>$this->gateway->clientToken()->generate()]);
    }

    public function checkout(Request $request) {
        $nonce = $request->input('payment_method_nonce');
        $deviceData = $request->input('device_data');
        $time_period = $request->input('time_period');

        try {
            $vault = $this->gateway->customer()->create([
                'firstName' => 'Jon',
                'lastName' => 'Jon',
                'paymentMethodNonce' => $nonce,
                'deviceData' => $deviceData
            ]);
            
            $create['user_id'] = $request->user()->id;
            $create['time_period'] = $time_period;
            if ($vault->customer->paypalAccounts) {
                $create['paypal_billing_agreement_id'] = $vault->customer->paypalAccounts[0]->billingAgreementId;
                $create['paypal_payer_id'] = $vault->customer->paypalAccounts[0]->payerId;
                $create['braintree_vault_id'] = $vault->customer->paypalAccounts[0]->token;
                $create['paymentType'] = PaymentType::PAYPAL;
                $vaultId = $vault->customer->paypalAccounts[0]->token;
            }
            
            $planId = "BRAINTREE_{$time_period}_NAME";
            logger("plan id $planId");
            $sub = $this->gateway->subscription()->create([
                'paymentMethodToken' => $vaultId,
                'planId' => env($planId)
            ]);
            if ($sub->success) {
                $create['subscription_id'] = $sub->subscription->id;
                $create['braintree_plan_id'] = $sub->subscription->planId;
                $create['subscription_id'] = $sub->subscription->id;
            }

        } catch (Exception $e) {
            logger($e->getMessage());
            return response()->json(['status' => 'failed']);
        }

        if ($sub instanceof Error) {
            logger($sub);
            return response()->json(['status' => 'failed']);
        }
        
        Subscriptions::create($create);
        return response()->json(['status' => 'success']);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);
    }
}
