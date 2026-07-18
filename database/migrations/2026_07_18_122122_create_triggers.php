<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // ==========================================
        // TRIGGER 1: Auto-log application status changes
        // When application status changes, automatically insert a log entry
        // ==========================================
        DB::unprepared("
            CREATE TRIGGER trg_after_application_update
            AFTER UPDATE ON applications
            FOR EACH ROW
            BEGIN
                IF OLD.status != NEW.status THEN
                    INSERT INTO application_status_logs (
                        application_id, old_status, new_status, notes, created_at, updated_at
                    ) VALUES (
                        NEW.id, OLD.status, NEW.status, 'Status changed by system trigger', NOW(), NOW()
                    );
                END IF;
            END;
        ");

        // ==========================================
        // TRIGGER 2: Auto-calculate student profile completion percentage
        // Runs before every student profile update
        // ==========================================
        DB::unprepared("
            CREATE TRIGGER trg_before_student_update
            BEFORE UPDATE ON students
            FOR EACH ROW
            BEGIN
                DECLARE completion INT DEFAULT 0;

                IF NEW.university IS NOT NULL AND NEW.university != '' THEN SET completion = completion + 14; END IF;
                IF NEW.department IS NOT NULL AND NEW.department != '' THEN SET completion = completion + 14; END IF;
                IF NEW.cgpa IS NOT NULL THEN SET completion = completion + 14; END IF;
                IF NEW.current_semester IS NOT NULL THEN SET completion = completion + 14; END IF;
                IF NEW.skills IS NOT NULL AND JSON_LENGTH(NEW.skills) > 0 THEN SET completion = completion + 14; END IF;
                IF NEW.research_interests IS NOT NULL AND JSON_LENGTH(NEW.research_interests) > 0 THEN SET completion = completion + 14; END IF;
                IF NEW.resume_path IS NOT NULL AND NEW.resume_path != '' THEN SET completion = completion + 8; END IF;
                IF NEW.profile_picture_path IS NOT NULL AND NEW.profile_picture_path != '' THEN SET completion = completion + 8; END IF;

                SET NEW.profile_completion_percentage = LEAST(completion, 100);
            END;
        ");

        // ==========================================
        // TRIGGER 3: Auto-generate notification on application status change
        // When status changes to accepted/rejected/shortlisted, notify the student
        // ==========================================
        DB::unprepared("
            CREATE TRIGGER trg_after_application_update_notify
            AFTER UPDATE ON applications
            FOR EACH ROW
            BEGIN
                DECLARE student_user_id BIGINT;
                DECLARE opp_title VARCHAR(500);

                IF OLD.status != NEW.status AND NEW.status IN ('accepted', 'rejected', 'shortlisted') THEN
                    SELECT user_id INTO student_user_id FROM students WHERE id = NEW.student_id LIMIT 1;
                    SELECT title INTO opp_title FROM opportunities WHERE id = NEW.opportunity_id LIMIT 1;

                    IF student_user_id IS NOT NULL THEN
                        INSERT INTO notifications (
                            id, notifiable_type, notifiable_id, type, data, read_at, created_at, updated_at
                        ) VALUES (
                            UUID(),
                            'App\\\\Models\\\\User',
                            student_user_id,
                            'App\\\\Notifications\\\\ApplicationStatusChanged',
                            CONCAT('{\"message\":\"Your application for \\\"', IFNULL(opp_title, 'Unknown'), '\\\" has been ', NEW.status, '\",\"status\":\"', NEW.status, '\"}'),
                            NULL,
                            NOW(),
                            NOW()
                        );
                    END IF;
                END IF;
            END;
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS trg_after_application_update;");
        DB::unprepared("DROP TRIGGER IF EXISTS trg_before_student_update;");
        DB::unprepared("DROP TRIGGER IF EXISTS trg_after_application_update_notify;");
    }
};