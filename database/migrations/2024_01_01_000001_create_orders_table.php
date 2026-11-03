<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('service_type', ['fast_clean', 'deep_clean', 'suede_treatment']);
            $table->integer('shoe_quantity')->default(1);
            $table->boolean('is_pickup')->default(false);
            $table->text('pickup_address')->nullable();
            $table->decimal('pickup_fee', 10, 2)->default(0);
            $table->decimal('service_price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->enum('payment_method', ['cash', 'transfer_bca', 'transfer_mandiri', 'transfer_bni', 'gopay', 'ovo', 'dana', 'qris']);
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->enum('status', ['on_hold', 'process', 'done', 'cancelled'])->default('on_hold');
            $table->text('notes')->nullable();
            $table->text('admin_notes')->nullable();
            $table->string('shoe_brand')->nullable();
            $table->string('shoe_color')->nullable();
            $table->timestamp('estimated_done_at')->nullable();
            $table->timestamp('done_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
