<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210614061710 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_notes ADD matiere_id INT DEFAULT NULL, ADD commentaire LONGTEXT DEFAULT NULL, DROP nom');
        $this->addSql('ALTER TABLE fiche_notes ADD CONSTRAINT FK_7B9B4CB3F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere_niveau_filiere (id)');
        $this->addSql('CREATE INDEX IDX_7B9B4CB3F46CD258 ON fiche_notes (matiere_id)');
        $this->addSql('ALTER TABLE note CHANGE note_ds note_ds DOUBLE PRECISION DEFAULT NULL, CHANGE note_tp note_tp DOUBLE PRECISION DEFAULT NULL, CHANGE note_examen note_examen DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_notes DROP FOREIGN KEY FK_7B9B4CB3F46CD258');
        $this->addSql('DROP INDEX IDX_7B9B4CB3F46CD258 ON fiche_notes');
        $this->addSql('ALTER TABLE fiche_notes ADD nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP matiere_id, DROP commentaire');
        $this->addSql('ALTER TABLE note CHANGE note_ds note_ds DOUBLE PRECISION NOT NULL, CHANGE note_tp note_tp DOUBLE PRECISION NOT NULL, CHANGE note_examen note_examen DOUBLE PRECISION NOT NULL');
    }
}
