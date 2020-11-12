<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200703182404 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant ADD numero_chambre_id INT DEFAULT NULL, DROP numero_chambre');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3FBEAE2F7 FOREIGN KEY (numero_chambre_id) REFERENCES chambre (id)');
        $this->addSql('CREATE INDEX IDX_717E22E3FBEAE2F7 ON etudiant (numero_chambre_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3FBEAE2F7');
        $this->addSql('DROP INDEX IDX_717E22E3FBEAE2F7 ON etudiant');
        $this->addSql('ALTER TABLE etudiant ADD numero_chambre VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP numero_chambre_id');
    }
}
