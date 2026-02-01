Schema::create('admins', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->string('password');   // BẮT BUỘC
    $table->string('phone')->nullable();
    $table->timestamps();
});