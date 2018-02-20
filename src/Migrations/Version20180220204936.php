<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180220204936 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pago_solped (pago_id INT NOT NULL, solped_id INT NOT NULL, INDEX IDX_AE54CECE63FB8380 (pago_id), INDEX IDX_AE54CECE1D4EF6B2 (solped_id), PRIMARY KEY(pago_id, solped_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pago_oc (pago_id INT NOT NULL, oc_id INT NOT NULL, INDEX IDX_ABC5B1A563FB8380 (pago_id), INDEX IDX_ABC5B1A56DD3534E (oc_id), PRIMARY KEY(pago_id, oc_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pago_solped ADD CONSTRAINT FK_AE54CECE63FB8380 FOREIGN KEY (pago_id) REFERENCES pago (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pago_solped ADD CONSTRAINT FK_AE54CECE1D4EF6B2 FOREIGN KEY (solped_id) REFERENCES solped (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pago_oc ADD CONSTRAINT FK_ABC5B1A563FB8380 FOREIGN KEY (pago_id) REFERENCES pago (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pago_oc ADD CONSTRAINT FK_ABC5B1A56DD3534E FOREIGN KEY (oc_id) REFERENCES oc (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE transaccion');
        $this->addSql('ALTER TABLE proveedor ADD contrato TINYTEXT NOT NULL');
        $this->addSql('ALTER TABLE pago ADD proveedor_id INT DEFAULT NULL, ADD descripcion LONGTEXT NOT NULL, ADD estado INT NOT NULL, ADD created DATETIME NOT NULL');
        $this->addSql('ALTER TABLE pago ADD CONSTRAINT FK_F4DF5F3ECB305D73 FOREIGN KEY (proveedor_id) REFERENCES proveedor (id)');
        $this->addSql('CREATE INDEX IDX_F4DF5F3ECB305D73 ON pago (proveedor_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE transaccion (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE pago_solped');
        $this->addSql('DROP TABLE pago_oc');
        $this->addSql('ALTER TABLE pago DROP FOREIGN KEY FK_F4DF5F3ECB305D73');
        $this->addSql('DROP INDEX IDX_F4DF5F3ECB305D73 ON pago');
        $this->addSql('ALTER TABLE pago DROP proveedor_id, DROP descripcion, DROP estado, DROP created');
        $this->addSql('ALTER TABLE proveedor DROP contrato');
    }
}
