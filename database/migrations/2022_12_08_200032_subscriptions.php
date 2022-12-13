<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('paypal_billing_agreement_id');
            $table->string('paypal_payer_id');
            $table->string('braintree_vault_id');
            $table->string('braintree_plan_id');
            $table->string('subscription_id');
            $table->enum('time_period', ['MONTHLY', 'YEARLY']);
            $table->enum('status', ['ACTIVE', 'CANCELED']);
            $table->enum('paymentType', ['CREDIT_CARD', 'PAYPAL']);
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();
            $table->index('paypal_billing_agreement_id');
            $table->index('braintree_vault_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
};
