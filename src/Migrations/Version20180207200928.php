<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180207200928 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE proveedor (id INT AUTO_INCREMENT NOT NULL, rut TINYTEXT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE compra ADD proveedor_id INT DEFAULT NULL, ADD descripcion LONGTEXT NOT NULL, ADD solicitante VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE compra ADD CONSTRAINT FK_9EC131FFCB305D73 FOREIGN KEY (proveedor_id) REFERENCES proveedor (id)');
        $this->addSql('CREATE INDEX IDX_9EC131FFCB305D73 ON compra (proveedor_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compra DROP FOREIGN KEY FK_9EC131FFCB305D73');
        $this->addSql('DROP TABLE proveedor');
        $this->addSql('DROP INDEX IDX_9EC131FFCB305D73 ON compra');
        $this->addSql('ALTER TABLE compra DROP proveedor_id, DROP descripcion, DROP solicitante');
    }
}
