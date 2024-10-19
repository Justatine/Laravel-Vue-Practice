<?php

use App\Models\Posts;
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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->text('file')->nullable();
            $table->timestamps();
        });

        Posts::insert([
            [
                'title'=>'Post 1',
                'content'=>'Post 1 content',
                'file'=> null,
                'created_at'=>now(),
                'updated_at' => now()
            ],
            [
                'title'=>'Post 2',
                'content'=>'Post 2 content',
                'file'=> null,
                'created_at'=>now(),
                'updated_at' => now()
            ],
            [
                'title'=>'Post 3',
                'content'=>'Post 3 content',
                'file'=> null,
                'created_at'=>now(),
                'updated_at' => now()            
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
