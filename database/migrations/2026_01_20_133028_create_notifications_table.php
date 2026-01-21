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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // notification type: new_order, new_user, new_message, etc.
            $table->string('title'); // notification title
            $table->text('message'); // notification message
            $table->string('url')->nullable(); // link to related resource
            $table->boolean('is_read')->default(false); // read status
            $table->timestamp('read_at')->nullable(); // when it was read
            $table->morphs('notifiable'); // related model (user, order, etc.)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
