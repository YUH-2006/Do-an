<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::create('admins', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        // Giới hạn 191 ký tự để không bị lỗi "1071 Specified key was too long"
        $table->string('email', 191)->unique(); 
        $table->string('password');
        $table->rememberToken();
        $table->timestamps();
    });
}
};