<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241017225119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detailcommande ADD commande_id INT NOT NULL');
        $this->addSql('ALTER TABLE detailcommande ADD CONSTRAINT FK_7D6DC7D582EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_7D6DC7D582EA2E54 ON detailcommande (commande_id)');
        $this->addSql('ALTER TABLE detailfacture ADD facture_id INT NOT NULL');
        $this->addSql('ALTER TABLE detailfacture ADD CONSTRAINT FK_157F9A087F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('CREATE INDEX IDX_157F9A087F2DEE08 ON detailfacture (facture_id)');
        $this->addSql('ALTER TABLE facture ADD client_id INT NOT NULL');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641019EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_FE86641019EB6921 ON facture (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detailcommande DROP FOREIGN KEY FK_7D6DC7D582EA2E54');
        $this->addSql('DROP INDEX IDX_7D6DC7D582EA2E54 ON detailcommande');
        $this->addSql('ALTER TABLE detailcommande DROP commande_id');
        $this->addSql('ALTER TABLE detailfacture DROP FOREIGN KEY FK_157F9A087F2DEE08');
        $this->addSql('DROP INDEX IDX_157F9A087F2DEE08 ON detailfacture');
        $this->addSql('ALTER TABLE detailfacture DROP facture_id');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641019EB6921');
        $this->addSql('DROP INDEX IDX_FE86641019EB6921 ON facture');
        $this->addSql('ALTER TABLE facture DROP client_id');
    }
}
