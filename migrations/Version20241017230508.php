<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241017230508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detailfacture ADD article_id INT NOT NULL');
        $this->addSql('ALTER TABLE detailfacture ADD CONSTRAINT FK_157F9A087294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_157F9A087294869C ON detailfacture (article_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detailfacture DROP FOREIGN KEY FK_157F9A087294869C');
        $this->addSql('DROP INDEX IDX_157F9A087294869C ON detailfacture');
        $this->addSql('ALTER TABLE detailfacture DROP article_id');
    }
}
