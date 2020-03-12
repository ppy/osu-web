<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class StoreBaseTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $builder = Schema::connection('mysql-store');

        $builder->create('addresses', function (Blueprint $table) {
            $table->increments('address_id');
            $table->integer('user_id')->unsigned()->nullable()->index('user_id');
            $table->string('first_name', 256)->nullable();
            $table->string('last_name', 256)->nullable();
            $table->string('street', 2048)->nullable();
            $table->string('city', 128)->nullable();
            $table->string('state', 128)->nullable();
            $table->string('zip', 128)->nullable();
            $table->string('country_code', 2)->nullable();
            $table->string('phone', 96)->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->timestamp('updated_at')->nullable();
        });

        $builder->create('orders', function (Blueprint $table) {
            $table->increments('order_id');
            $table->integer('user_id')->unsigned();
            $table->enum('status', ['incart', 'checkout', 'paid', 'shipped', 'cancelled', 'delivered'])->default('incart');
            $table->integer('address_id')->unsigned()->nullable();
            $table->string('tracking_code', 1024)->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->timestamp('updated_at')->nullable();

            $table->index('user_id', 'user_id');
            $table->index('address_id', 'address_id');
            $table->index('status', 'status');
            $table->foreign('address_id', 'orders_ibfk_1')->references('address_id')->on('addresses')->onUpdate('RESTRICT')->onDelete('SET NULL');
        });
        $builder->getConnection()->statement('ALTER TABLE `orders` COMMENT = \'stores orders in all states (including cart contents).\';');

        $builder->create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('quantity')->unsigned()->default(1);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->timestamp('updated_at')->nullable();
            $table->unique(['order_id', 'product_id'], 'order_id_product_id');
            $table->foreign('order_id', 'FK_order_items_orders')->references('order_id')->on('orders')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });

        $builder->create('products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->decimal('cost', 10)->nullable();
            $table->integer('weight')->nullable()->default(0);
            $table->decimal('base_shipping', 10)->default(5.00);
            $table->decimal('next_shipping', 10)->default(1.00);
            $table->integer('stock')->nullable()->default(0);
            $table->boolean('max_quantity')->unsigned()->default(10);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $builder = Schema::connection('mysql-store');

        $builder->drop('products');
        $builder->drop('order_items');
        $builder->drop('orders');
        $builder->drop('addresses');
    }
}
