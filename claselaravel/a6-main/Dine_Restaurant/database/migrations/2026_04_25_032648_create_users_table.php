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
        Schema::create('users', function (Blueprint $table) {
         $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password');
        $table->foreignId('role_id')->constrained()->onDelete('restrict'); //No deberia permitir borrar el rol/usuario si por ejemplo esta atendiendo una mesa
        //Este campo los camareros lo tendrian nulo, ya que atienden N mesas, es un campo para los clientes
        $table->foreignId('table_id')->nullable()->constrained('tables')->onDelete('set null');
        $table->boolean('active')->default(true);
        $table->rememberToken();
        $table->softDeletes();
        $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
