<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180220182545 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE detalle ADD compra_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detalle ADD CONSTRAINT FK_80397C30F2E704D7 FOREIGN KEY (compra_id) REFERENCES compra (id)');
        $this->addSql('CREATE INDEX IDX_80397C30F2E704D7 ON detalle (compra_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE detalle DROP FOREIGN KEY FK_80397C30F2E704D7');
        $this->addSql('DROP INDEX IDX_80397C30F2E704D7 ON detalle');
        $this->addSql('ALTER TABLE detalle DROP compra_id');
    }
}
