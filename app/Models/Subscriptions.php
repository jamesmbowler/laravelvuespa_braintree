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
}
