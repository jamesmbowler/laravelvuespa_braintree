<?php

namespace App\Models;

use App\Enums\PaymentType;
use App\Enums\SubscriptionDuration;
use App\Enums\SubscriptionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Enums;

class Subscriptions extends Model
{
    use HasFactory;

    protected SubscriptionStatus $status;
    protected SubscriptionDuration $time_period;
    protected PaymentType $paymentType;


    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * We don't want all attributes shown to user
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'paypal_billing_agreement_id',
        'user_id',
        'paypal_payer_id',
        'braintree_vault_id',
        'subscription_id'
    ];
}
