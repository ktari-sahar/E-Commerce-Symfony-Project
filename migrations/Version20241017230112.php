<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241017230112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detailcommande ADD article_id INT NOT NULL');
        $this->addSql('ALTER TABLE detailcommande ADD CONSTRAINT FK_7D6DC7D57294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_7D6DC7D57294869C ON detailcommande (article_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detailcommande DROP FOREIGN KEY FK_7D6DC7D57294869C');
        $this->addSql('DROP INDEX IDX_7D6DC7D57294869C ON detailcommande');
        $this->addSql('ALTER TABLE detailcommande DROP article_id');
    }
}
