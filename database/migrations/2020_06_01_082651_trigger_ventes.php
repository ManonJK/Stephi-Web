<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TriggerVentes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE TRIGGER new_vente AFTER INSERT ON biens
            FOR EACH ROW
            BEGIN
            DECLARE agent INT;
            INSERT INTO ventes (status, date_parution, id_bien) VALUES ('En cours', NOW(), NEW.id);
            SELECT id_agent INTO agent FROM users WHERE id = NEW.id_user;
            IF agent IS NULL THEN
            UPDATE users SET id_agent = (SELECT id FROM agents ORDER BY RAND() LIMIT 1) WHERE id = NEW.id_user;
            END IF;
            END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `new_vente`');
    }
}
