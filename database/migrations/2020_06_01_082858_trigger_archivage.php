<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TriggerArchivage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE TRIGGER archivage BEFORE DELETE ON users
            FOR EACH ROW
            BEGIN
            DECLARE user_id INT;
            SET user_id = OLD.id;
            INSERT INTO archives(id, nom, prenom, email, birth_date, phone, id_agent) VALUES (OLD.id, OLD.nom, OLD.prenom, OLD.email, OLD.birth_date, OLD.phone, OLD.id_agent);
            INSERT INTO archives_biens(id, superficie, nb_pieces, etage, localisation, descriptif, prix_min, prix_max, prix_vente, id_user, id_type) SELECT id, superficie, nb_pieces, etage, localisation, descriptif, prix_min, prix_max, prix_vente, id_user, id_type FROM biens WHERE id_user = user_id;
            DELETE FROM ventes WHERE id_bien IN (SELECT id FROM biens WHERE id_user = user_id);
            DELETE FROM biens WHERE id_user = user_id;
            END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `archivage`');
    }
}
