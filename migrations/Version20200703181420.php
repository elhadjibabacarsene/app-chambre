<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200703181420 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE batiment (id INT AUTO_INCREMENT NOT NULL, numero VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chambre (id INT AUTO_INCREMENT NOT NULL, id_batiment_id INT NOT NULL, id_type_chambre_id INT NOT NULL, numero VARCHAR(255) NOT NULL, INDEX IDX_C509E4FFCEE444EC (id_batiment_id), INDEX IDX_C509E4FF6F4A6AF9 (id_type_chambre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, id_type_bourse_id INT DEFAULT NULL, matricule VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(20) NOT NULL, date_naissance DATE NOT NULL, statut TINYINT(1) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, inshoused TINYINT(1) DEFAULT NULL, numero_chambre VARCHAR(255) DEFAULT NULL, INDEX IDX_717E22E3C7C721C7 (id_type_bourse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_bourse (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, montant INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_chambre (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FFCEE444EC FOREIGN KEY (id_batiment_id) REFERENCES batiment (id)');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FF6F4A6AF9 FOREIGN KEY (id_type_chambre_id) REFERENCES type_chambre (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3C7C721C7 FOREIGN KEY (id_type_bourse_id) REFERENCES type_bourse (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FFCEE444EC');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3C7C721C7');
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FF6F4A6AF9');
        $this->addSql('DROP TABLE batiment');
        $this->addSql('DROP TABLE chambre');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE type_bourse');
        $this->addSql('DROP TABLE type_chambre');
    }
}
