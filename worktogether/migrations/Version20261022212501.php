<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261022212501 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Make Client a Utilisateur subtype and move client rows to the utilisateur table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D19EB6921');
        $this->addSql('ALTER TABLE utilisateur ADD raison_sociale VARCHAR(255) DEFAULT NULL, ADD adresse VARCHAR(255) DEFAULT NULL');
        $this->addSql("INSERT INTO utilisateur (email, password, nom, prenom, created_at, type, raison_sociale, adresse) SELECT email, password, nom, prenom, created_at, 'client', raison_sociale, adresse FROM client");
        $this->addSql("UPDATE commande cm INNER JOIN client cl ON cl.id = cm.client_id INNER JOIN utilisateur u ON u.email = cl.email AND u.type = 'client' SET cm.client_id = u.id");
        $this->addSql('DROP TABLE client');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D19EB6921');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, raison_sociale VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_C7440455E7927C74 (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql("INSERT INTO client (email, password, nom, prenom, raison_sociale, adresse, created_at) SELECT email, password, nom, prenom, raison_sociale, adresse, created_at FROM utilisateur WHERE type = 'client'");
        $this->addSql("UPDATE commande cm INNER JOIN utilisateur u ON u.id = cm.client_id INNER JOIN client cl ON cl.email = u.email AND u.type = 'client' SET cm.client_id = cl.id");
        $this->addSql("DELETE FROM utilisateur WHERE type = 'client'");
        $this->addSql('ALTER TABLE utilisateur DROP raison_sociale, DROP adresse');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }
}
