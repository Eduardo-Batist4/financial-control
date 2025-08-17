<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
<<<<<<< HEAD
        Schema::table('account', function (Blueprint $table) {
=======
        Schema::table('accounts', function (Blueprint $table) {
>>>>>>> feat-crud-account-and-category
            $table->softDeletes();
        });
    }

    public function down(): void
    {
<<<<<<< HEAD
        Schema::table('account', function (Blueprint $table) {
=======
        Schema::table('accounts', function (Blueprint $table) {
>>>>>>> feat-crud-account-and-category
            $table->dropSoftDeletes();
        });
    }
};
