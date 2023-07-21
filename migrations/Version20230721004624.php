<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230721004624 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sport_event ADD organizer_id INT NOT NULL');
        $this->addSql('ALTER TABLE sport_event ADD CONSTRAINT FK_8FD26BBE876C4DDA FOREIGN KEY (organizer_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8FD26BBE876C4DDA ON sport_event (organizer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sport_event DROP FOREIGN KEY FK_8FD26BBE876C4DDA');
        $this->addSql('DROP INDEX IDX_8FD26BBE876C4DDA ON sport_event');
        $this->addSql('ALTER TABLE sport_event DROP organizer_id');
    }
}
