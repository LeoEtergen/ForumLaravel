<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('photo')->nullable();
            $table->boolean('is_admin')->default(false);

            // removemos o sistema de roles, já que não era necessário para o momento, e colocamos esse 
            // atributo boolean para determinar se o usuário vai poder ser "admin"
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('photo');
            $table->dropColumn('is_admin');
        });
    }
};
