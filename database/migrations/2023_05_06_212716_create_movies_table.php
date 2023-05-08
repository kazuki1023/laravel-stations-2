<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Movie;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id('unsigned big integer')->autoIncrement()->comment('ID');
            $table->text('title')->comment('タイトル');
            $table->text('image_url')->comment('画像URL');
            $table->timestamp('created_at')->default(Movie::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->timestamp('updated_at')->default(Movie::raw('CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->text('description')->nullable()->comment('概要');
            $table->integer('published_year')->nullable()->comment('公開年');
            $table->tinyInteger('is_showing')->default(false)->comment('上映中かどうか');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
