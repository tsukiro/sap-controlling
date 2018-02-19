<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180219203851 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compra ADD detalle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE compra ADD CONSTRAINT FK_9EC131FF9EA59ED2 FOREIGN KEY (detalle_id) REFERENCES detalle (id)');
        $this->addSql('CREATE INDEX IDX_9EC131FF9EA59ED2 ON compra (detalle_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compra DROP FOREIGN KEY FK_9EC131FF9EA59ED2');
        $this->addSql('DROP INDEX IDX_9EC131FF9EA59ED2 ON compra');
        $this->addSql('ALTER TABLE compra DROP detalle_id');
    }
}
