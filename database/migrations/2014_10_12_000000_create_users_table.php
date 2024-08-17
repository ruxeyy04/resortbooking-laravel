<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('account_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('username')->nullable();
            $table->string('password');
            $table->string('contact_number')->nullable();
            $table->string('user_type')->default('customer');
            $table->timestamps();
        });

        User::insert([
            [
                'first_name' =>'Marck',
                'last_name'=>'Balucan',
                'email'=>'admin@gmail.com',
                'username'=>'admin',
                'password'=>'$2y$12$0Bk2aTZtfZ9ecweHJLW9L.bU/dAMll8EMFwvutQNu4nID2qSZguqm',
                'contact_number'=>'09123456789',
                'user_type'=>'admin'
            ],
            [
                'first_name' =>'Benedict',
                'last_name'=>'Marb',
                'email'=>'incharge@gmail.com',
                'username'=>'incharge',
                'password'=>'$2y$12$0Bk2aTZtfZ9ecweHJLW9L.bU/dAMll8EMFwvutQNu4nID2qSZguqm',
                'contact_number'=>'09123456789',
                'user_type'=>'in-charge'
            ],
            [
                'first_name' =>'John',
                'last_name'=>'Doe',
                'email'=>'customer@gmail.com',
                'username'=>'customer',
                'password'=>'$2y$12$0Bk2aTZtfZ9ecweHJLW9L.bU/dAMll8EMFwvutQNu4nID2qSZguqm',
                'contact_number'=>'09123456789',
                'user_type'=>'customer'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
