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
        Schema::create('sys_menu', function (Blueprint $table) {
            $table->id("menu_codigo");
            $table->string("menu_description");
            $table->string("menu_link");
            $table->string("menu_permission");
            $table->string("menu_icon");
            $table->string("menu_nivel");
            $table->timestamp("menu_data_registration")->nullable();
            $table->timestamp("updated_at")->nullable();
            $table->char("menu_active", 255);
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sys_menu');
    }
};
