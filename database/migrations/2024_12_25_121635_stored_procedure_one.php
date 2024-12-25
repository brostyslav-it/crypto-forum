<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $this->down();
        DB::unprepared('
            CREATE PROCEDURE CalculatePostPopularity(IN post_id INT)
            BEGIN
                DECLARE like_count INT;
                DECLARE dislike_count INT;
                DECLARE comment_count INT;
                DECLARE popularity_score INT;

                SELECT COUNT(*) INTO like_count
                FROM likes
                WHERE post_id = post_id;

                SELECT COUNT(*) INTO dislike_count
                FROM dislikes
                WHERE post_id = post_id;

                SELECT COUNT(*) INTO comment_count
                FROM comments
                WHERE post_id = post_id;

                SET popularity_score = (like_count - dislike_count) * 10 + (comment_count * 5);

                SELECT popularity_score AS score;
            END
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS CalculatePostPopularity');
    }
};
