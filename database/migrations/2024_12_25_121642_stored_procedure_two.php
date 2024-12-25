<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $this->down();
        DB::unprepared('
            CREATE PROCEDURE GetUsersWhoLikedPost(IN post_id INT)
            BEGIN
                SELECT u.id AS user_id, u.name AS user_name, u.email AS user_email, u.avatar AS user_avatar
                FROM users u
                JOIN likes l ON u.id = l.user_id
                WHERE l.post_id = post_id;
            END;
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS GetUsersWhoLikedPost');
    }
};
