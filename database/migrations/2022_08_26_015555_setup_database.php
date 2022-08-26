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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id')->nullable();
            $table->decimal('balance', 12, 2);
            $table->boolean('allow_receive')->default(true);
            $table->boolean('allow_send')->default(true);
            $table->timestamps();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_wallet_id');
            $table->unsignedBigInteger('to_wallet_id');
            $table->decimal('value', 12, 2);
            $table->foreign('from_wallet_id')->references('id')->on('wallets');
            $table->foreign('to_wallet_id')->references('id')->on('wallets');
            $table->timestamps();
        });

        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('cpf');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_seller')->default(false);
            $table->unsignedBigInteger('wallet_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('wallet_id')->references('id')->on('wallets')->nullOnDelete();
        });

        Schema::table('wallets', function (Blueprint $table) {
            $table->foreign('account_id')->references('id')->on('accounts')->nullOnDelete();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wallets', function (Blueprint $table) {
            $table->dropConstrainedForeignId('account_id');
        });

        Schema::dropIfExists('accounts');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('wallets');
    }
};
