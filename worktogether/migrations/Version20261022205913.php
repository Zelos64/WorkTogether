<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261022205913 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create the offre and baie tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE baie (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(4) NOT NULL, hauteur_u INT DEFAULT 42 NOT NULL, localisation VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_709904BA77153098 (code), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE offre (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, nombre_unites INT NOT NULL, prix_mensuel NUMERIC(10, 2) NOT NULL, remise_annuelle NUMERIC(5, 2) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE offre');
        $this->addSql('DROP TABLE baie');
    }
}
