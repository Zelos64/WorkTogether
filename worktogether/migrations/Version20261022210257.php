<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261022210257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create commande, unite, ligne_commande, intervention and intervention_unite tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, reference VARCHAR(191) NOT NULL, date_commande DATETIME NOT NULL, periodicite VARCHAR(20) NOT NULL, tacite_reconduction TINYINT NOT NULL, statut VARCHAR(255) NOT NULL, client_id INT NOT NULL, UNIQUE INDEX UNIQ_6EEAA67DAEA34913 (reference), INDEX IDX_6EEAA67D19EB6921 (client_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE intervention (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE intervention_unite (id INT AUTO_INCREMENT NOT NULL, notes LONGTEXT DEFAULT NULL, intervention_id INT NOT NULL, unite_id INT NOT NULL, UNIQUE INDEX uniq_intervention_unite (intervention_id, unite_id), INDEX IDX_6801DD9C8EAE3863 (intervention_id), INDEX IDX_6801DD9CEC4A74AB (unite_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE ligne_commande (id INT AUTO_INCREMENT NOT NULL, quantite INT NOT NULL, prix_unitaire_applique NUMERIC(10, 2) NOT NULL, commande_id INT NOT NULL, offre_id INT NOT NULL, unite_id INT DEFAULT NULL, INDEX IDX_3170B74B82EA2E54 (commande_id), INDEX IDX_3170B74B4CC8505A (offre_id), INDEX IDX_3170B74BEC4A74AB (unite_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE unite (id INT AUTO_INCREMENT NOT NULL, position VARCHAR(3) NOT NULL, nom VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, couleur VARCHAR(255) DEFAULT NULL, etat VARCHAR(255) NOT NULL, baie_id INT NOT NULL, INDEX IDX_1D64C11843375062 (baie_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE intervention_unite ADD CONSTRAINT FK_6801DD9C8EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id)');
        $this->addSql('ALTER TABLE intervention_unite ADD CONSTRAINT FK_6801DD9CEC4A74AB FOREIGN KEY (unite_id) REFERENCES unite (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74BEC4A74AB FOREIGN KEY (unite_id) REFERENCES unite (id)');
        $this->addSql('ALTER TABLE unite ADD CONSTRAINT FK_1D64C11843375062 FOREIGN KEY (baie_id) REFERENCES baie (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE intervention_unite');
        $this->addSql('DROP TABLE ligne_commande');
        $this->addSql('DROP TABLE unite');
        $this->addSql('DROP TABLE intervention');
        $this->addSql('DROP TABLE commande');
    }
}
