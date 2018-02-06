<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180206122530 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaccion DROP solped, DROP oc');
        $this->addSql('ALTER TABLE compra DROP solped, DROP oc');
        $this->addSql('ALTER TABLE pago DROP solped, DROP oc');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compra ADD solped INT DEFAULT NULL, ADD oc INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pago ADD solped INT DEFAULT NULL, ADD oc INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transaccion ADD solped INT DEFAULT NULL, ADD oc INT DEFAULT NULL');
    }
}
