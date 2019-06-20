<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateOrdersTable extends Migration
    {
        public function up()
        {
            Schema::create('orders', function (Blueprint $table) {
                $table->increments('id');
                $table->string('image');
                $table->integer('product_id');
                $table->integer('user_id');
                $table->integer('cart_id');
                $table->integer('quantity')->default(1);
                $table->float('amount');
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('orders');
        }
    }