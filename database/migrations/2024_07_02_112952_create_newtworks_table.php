<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('newtworks', function (Blueprint $table) {
            $table->id();
            $table->string('referral_code')->nullable();
              $table->foreignIdFor(\App\Models\User::class, 'user_id')
            ->nullable()
            ->constrained('users')
            ->onDelete('set null');


            $table->foreignIdFor(\App\Models\User::class, 'parent_user_id')
            ->nullable()
            ->constrained('users')
            ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newtworks');
    }
};
