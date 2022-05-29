<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         //Schema::enableForeignKeyConstraints();
        Schema::table('posts', function (Blueprint $table) {
            // aggiungo chiave esterna
            $table->unsignedBigInteger('category_id')
                ->nullable()

                // va dopo user_id
                ->after('user_id');
                ;

            });
            //Schema::disableForeignKeyConstraints();


            Schema::table('posts', function (Blueprint $table) {
                // lego la tabella
                $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
                    // ->onDelete('SET NULL')
                    ;

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // dropForeign toglie solo la chiave esterna, serve anche dropColumn
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
}
