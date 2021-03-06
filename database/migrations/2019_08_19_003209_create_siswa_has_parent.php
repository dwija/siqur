<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswaHasParent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_siswa_has_parent', function (Blueprint $table) {
            $table->bigIncrements('id', 20);
            $table->unsignedBigInteger('parent_id');
            $table->unsignedBigInteger('siswa_id');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
    
            $table->foreign('parent_id')
                ->references('id')
                ->on('tbl_user')
                ->onDelete('cascade');

            $table->foreign('siswa_id')
                ->references('id')
                ->on('tbl_siswa')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_siswa_has_parent');
    }
}
