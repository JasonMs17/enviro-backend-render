<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('DROP VIEW IF EXISTS available_challenges');
        DB::statement("
            CREATE VIEW available_challenges AS
            SELECT 
                c.*,
                u.id AS user_id
            FROM challenges c
            CROSS JOIN users u
            LEFT JOIN challenge_reports cr ON c.id = cr.challenge_id AND cr.user_id = u.id
            WHERE cr.id IS NULL OR cr.completed_at IS NULL
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS available_challenges");
    }
};

