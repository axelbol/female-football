<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('bio')->nullable();
            $table->string('title')->nullable();
            $table->string('avatar')->nullable();
            $table->string('country')->nullable();
            $table->string('position')->nullable();
            $table->string('team')->nullable();
            $table->json('social_links')->nullable();
            $table->boolean('is_author')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'bio',
                'title',
                'avatar',
                'country',
                'position',
                'team',
                'social_links',
                'is_author'
            ]);
        });
    }
};
