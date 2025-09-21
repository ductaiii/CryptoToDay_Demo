<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('monad_address')->nullable();     // địa chỉ ví Monad
        $table->string('monad_private_key')->nullable(); // private key (demo thôi)
    });
}

    /**
     * Reverse the migrations.
     */
   public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['monad_address', 'monad_private_key']);
    });
}
};
