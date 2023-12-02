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
        Schema::create('items', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignIdFor(Category::class);
            $table->string("title")->unique();
            $table->string("description");
            $table->decimal("price");
            $table->bigInteger("quantity");
            $table->string("SKU");
            $table->binary("picture");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
