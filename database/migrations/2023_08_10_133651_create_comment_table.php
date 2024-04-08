<?php

use App\Enums\CommentStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('post_comments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('post_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->text('comment');
            $table->string('status')->default(CommentStatusEnum::PUBLISHED->value);
            $table->bigInteger('views');
            $table->bigInteger('likes');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('post_comments');
    }
};
