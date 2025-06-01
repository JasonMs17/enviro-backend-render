<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Drop the view if it exists first
        DB::statement('DROP VIEW IF EXISTS user_completed_materials');

        // Create the view
        DB::statement("
            CREATE VIEW user_completed_materials AS
            SELECT 
                material_reports.user_id,
                materials.material_id as material_id,
                materials.title,
                materials.content,
                materials.photo
            FROM material_reports
            JOIN materials ON material_reports.material_id = materials.material_id
            WHERE material_reports.progress = 100
        ");
    }

    public function down(): void
    {
        // Check if view exists before dropping
        $viewExists = DB::select("
            SELECT COUNT(*) as count 
            FROM information_schema.views 
            WHERE table_schema = DATABASE() 
            AND table_name = 'user_completed_materials'
        ");

        if ($viewExists[0]->count > 0) {
            DB::statement('DROP VIEW user_completed_materials');
        }
    }
};
