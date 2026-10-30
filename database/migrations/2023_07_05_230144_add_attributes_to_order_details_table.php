<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttributesToOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->string('removable')->after('price')->nullable();
            $table->string('drink')->after('price')->nullable();
            $table->string('sauce')->after('price')->nullable();
            $table->string('side')->after('price')->nullable();
            $table->string('flavour')->after('price')->nullable();
            $table->string('variation')->after('price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropColumn('removable');
            $table->dropColumn('drink');
            $table->dropColumn('sauce');
            $table->dropColumn('side');
            $table->dropColumn('flavour');
            $table->dropColumn('variation');
        });
    }
}
