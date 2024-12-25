<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->down();
        DB::unprepared('
            CREATE VIEW view_top_posts AS
            SELECT
                p.id AS post_id,
                p.title AS post_title,
                COUNT(l.id) AS total_likes
            FROM
                posts p
            LEFT JOIN
                likes l ON p.id = l.post_id
            GROUP BY
                p.id, p.title
            ORDER BY
                total_likes DESC;
        ');

        DB::unprepared('
            CREATE VIEW view_user_activity AS
            SELECT
                u.id AS user_id,
                u.name AS user_name,
                COUNT(DISTINCT p.id) AS total_posts,
                COUNT(DISTINCT l.id) AS total_likes_given,
                COUNT(DISTINCT c.id) AS total_comments
            FROM
                users u
            LEFT JOIN
                posts p ON u.id = p.user_id
            LEFT JOIN
                likes l ON u.id = l.user_id
            LEFT JOIN
                comments c ON u.id = c.user_id
            GROUP BY
                u.id, u.name;
        ');

        DB::unprepared('
            CREATE VIEW view_post_details AS
            SELECT
                p.id AS post_id,
                p.title AS post_title,
                u.name AS author_name,
                COUNT(DISTINCT l.id) AS total_likes,
                COUNT(DISTINCT c.id) AS total_comments
            FROM
                posts p
            JOIN
                users u ON p.user_id = u.id
            LEFT JOIN
                likes l ON p.id = l.post_id
            LEFT JOIN
                comments c ON p.id = c.post_id
            GROUP BY
                p.id, p.title, u.name;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP VIEW IF EXISTS view_top_posts;');
        DB::unprepared('DROP VIEW IF EXISTS view_user_activity;');
        DB::unprepared('DROP VIEW IF EXISTS view_post_details;');
    }
};
