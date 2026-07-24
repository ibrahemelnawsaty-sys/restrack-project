<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['pending', 'active', 'expired', 'cancelled', 'refunded'])->default('pending');
            $table->string('payment_id')->nullable();
            $table->string('payment_method', 50)->nullable();
            $table->enum('payment_gateway', ['moyasar', 'hyperpay', 'manual'])->default('moyasar');
            $table->decimal('amount', 8, 2);
            $table->string('currency', 3)->default('SAR');
            $table->foreignId('coupon_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('discount_amount', 8, 2)->default(0);
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            $table->json('gateway_response')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index('payment_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
