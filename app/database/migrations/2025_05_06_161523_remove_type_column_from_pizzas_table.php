<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // В миграции, которая будет создана
    public function up()
    {
        Schema::table('pizzas', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }

    public function down()
    {
        Schema::table('pizzas', function (Blueprint $table) {
            $table->string('type')->nullable();  // Возвращаем колонку, если потребуется откатить миграцию
        });
    }

};
