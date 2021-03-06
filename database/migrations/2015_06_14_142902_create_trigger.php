<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrigger extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::unprepared("
        CREATE TRIGGER `start_job`
        BEFORE INSERT ON `queues` FOR EACH ROW
        BEGIN
            UPDATE `campaigns`
            SET `status` = 'in progress'
            WHERE `id` = NEW.campaign_id;
        END
        ");

        DB::unprepared("
        CREATE TRIGGER `resume_job`
        BEFORE UPDATE ON `queues` FOR EACH ROW
          BEGIN
            IF new.pid != 0 AND new.status = 0
            THEN
              UPDATE `campaigns`
              SET `status` = 'in progress'
              WHERE `id` = NEW.campaign_id;
            END IF;
          END
        ");

        DB::unprepared("
        CREATE TRIGGER `end_pause_job`
        AFTER UPDATE ON `queues` FOR EACH ROW
          BEGIN
            IF new.status = 2
            THEN
              UPDATE `campaigns`
              SET `status` = 'paused'
              WHERE `id` = NEW.campaign_id;
            END IF;

            IF new.pid = 0 AND new.status = 1
            THEN
              UPDATE `campaigns`
              SET `status` = 'sent'
              WHERE `id` = NEW.campaign_id;
            END IF;
          END;
        "); //if pid=0 and status=1
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::unprepared("DROP TRIGGER IF EXISTS `start_job`;");
        DB::unprepared("DROP TRIGGER IF EXISTS `resume_job`;");
        DB::unprepared("DROP TRIGGER IF EXISTS `end_pause_job`;");
	}

}
