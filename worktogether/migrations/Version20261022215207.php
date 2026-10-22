<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261022215207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Convert tables to InnoDB so foreign keys are enforced, then create the foreign keys';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE utilisateur ENGINE = InnoDB');
        $this->addSql('ALTER TABLE baie ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ENGINE = InnoDB');
        $this->addSql('ALTER TABLE intervention ENGINE = InnoDB');
        $this->addSql('ALTER TABLE intervention_unite ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ligne_commande ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offre ENGINE = InnoDB');
        $this->addSql('ALTER TABLE unite ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE intervention_unite ADD CONSTRAINT FK_6801DD9C8EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id)');
        $this->addSql('ALTER TABLE intervention_unite ADD CONSTRAINT FK_6801DD9CEC4A74AB FOREIGN KEY (unite_id) REFERENCES unite (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74BEC4A74AB FOREIGN KEY (unite_id) REFERENCES unite (id)');
        $this->addSql('ALTER TABLE unite ADD CONSTRAINT FK_1D64C11843375062 FOREIGN KEY (baie_id) REFERENCES baie (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D19EB6921');
        $this->addSql('ALTER TABLE intervention_unite DROP FOREIGN KEY FK_6801DD9C8EAE3863');
        $this->addSql('ALTER TABLE intervention_unite DROP FOREIGN KEY FK_6801DD9CEC4A74AB');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B82EA2E54');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B4CC8505A');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74BEC4A74AB');
        $this->addSql('ALTER TABLE unite DROP FOREIGN KEY FK_1D64C11843375062');
        $this->addSql('ALTER TABLE utilisateur ENGINE = MyISAM');
        $this->addSql('ALTER TABLE baie ENGINE = MyISAM');
        $this->addSql('ALTER TABLE commande ENGINE = MyISAM');
        $this->addSql('ALTER TABLE intervention ENGINE = MyISAM');
        $this->addSql('ALTER TABLE intervention_unite ENGINE = MyISAM');
        $this->addSql('ALTER TABLE ligne_commande ENGINE = MyISAM');
        $this->addSql('ALTER TABLE offre ENGINE = MyISAM');
        $this->addSql('ALTER TABLE unite ENGINE = MyISAM');
    }
}
