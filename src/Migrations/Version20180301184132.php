<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180301184132 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE attachment (id INT AUTO_INCREMENT NOT NULL, compra_id INT DEFAULT NULL, pago_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, brochure VARCHAR(255) NOT NULL, created DATETIME NOT NULL, INDEX IDX_795FD9BBF2E704D7 (compra_id), INDEX IDX_795FD9BB63FB8380 (pago_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compra (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, proveedor_id INT DEFAULT NULL, descripcion LONGTEXT NOT NULL, created DATETIME NOT NULL, solicitante VARCHAR(255) NOT NULL, tipo INT NOT NULL, estado INT NOT NULL, INDEX IDX_9EC131FFDB38439E (usuario_id), INDEX IDX_9EC131FFCB305D73 (proveedor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compra_solped (compra_id INT NOT NULL, solped_id INT NOT NULL, INDEX IDX_7D8B0A5FF2E704D7 (compra_id), INDEX IDX_7D8B0A5F1D4EF6B2 (solped_id), PRIMARY KEY(compra_id, solped_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compra_oc (compra_id INT NOT NULL, oc_id INT NOT NULL, INDEX IDX_3AD936F2F2E704D7 (compra_id), INDEX IDX_3AD936F26DD3534E (oc_id), PRIMARY KEY(compra_id, oc_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detalle (id INT AUTO_INCREMENT NOT NULL, compra_id INT DEFAULT NULL, pago_id INT DEFAULT NULL, tipo INT NOT NULL, cantidad INT NOT NULL, descripcion LONGTEXT NOT NULL, medida VARCHAR(3) NOT NULL, tiempo VARCHAR(1) NOT NULL, valor NUMERIC(10, 2) NOT NULL, INDEX IDX_80397C30F2E704D7 (compra_id), INDEX IDX_80397C3063FB8380 (pago_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE distribucion (id INT AUTO_INCREMENT NOT NULL, compra_id INT DEFAULT NULL, pago_id INT DEFAULT NULL, tipo TINYINT(1) NOT NULL, cantidad INT NOT NULL, ceco VARCHAR(6) NOT NULL, cuenta VARCHAR(6) NOT NULL, INDEX IDX_698658A7F2E704D7 (compra_id), INDEX IDX_698658A763FB8380 (pago_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oc (id INT AUTO_INCREMENT NOT NULL, numero VARCHAR(255) NOT NULL, created DATETIME NOT NULL, estado INT NOT NULL, observacion LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pago (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, proveedor_id INT DEFAULT NULL, factura VARCHAR(255) NOT NULL, descripcion LONGTEXT NOT NULL, estado INT NOT NULL, tipo INT NOT NULL, created DATETIME NOT NULL, INDEX IDX_F4DF5F3EDB38439E (usuario_id), INDEX IDX_F4DF5F3ECB305D73 (proveedor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pago_solped (pago_id INT NOT NULL, solped_id INT NOT NULL, INDEX IDX_AE54CECE63FB8380 (pago_id), INDEX IDX_AE54CECE1D4EF6B2 (solped_id), PRIMARY KEY(pago_id, solped_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pago_oc (pago_id INT NOT NULL, oc_id INT NOT NULL, INDEX IDX_ABC5B1A563FB8380 (pago_id), INDEX IDX_ABC5B1A56DD3534E (oc_id), PRIMARY KEY(pago_id, oc_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proveedor (id INT AUTO_INCREMENT NOT NULL, rut TINYTEXT NOT NULL, contrato TINYTEXT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE servicios (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE solpago (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE solped (id INT AUTO_INCREMENT NOT NULL, numero VARCHAR(255) NOT NULL, created DATETIME NOT NULL, estado INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(64) NOT NULL, UNIQUE INDEX UNIQ_2265B05DE7927C74 (email), UNIQUE INDEX UNIQ_2265B05DF85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attachment ADD CONSTRAINT FK_795FD9BBF2E704D7 FOREIGN KEY (compra_id) REFERENCES compra (id)');
        $this->addSql('ALTER TABLE attachment ADD CONSTRAINT FK_795FD9BB63FB8380 FOREIGN KEY (pago_id) REFERENCES pago (id)');
        $this->addSql('ALTER TABLE compra ADD CONSTRAINT FK_9EC131FFDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE compra ADD CONSTRAINT FK_9EC131FFCB305D73 FOREIGN KEY (proveedor_id) REFERENCES proveedor (id)');
        $this->addSql('ALTER TABLE compra_solped ADD CONSTRAINT FK_7D8B0A5FF2E704D7 FOREIGN KEY (compra_id) REFERENCES compra (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compra_solped ADD CONSTRAINT FK_7D8B0A5F1D4EF6B2 FOREIGN KEY (solped_id) REFERENCES solped (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compra_oc ADD CONSTRAINT FK_3AD936F2F2E704D7 FOREIGN KEY (compra_id) REFERENCES compra (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compra_oc ADD CONSTRAINT FK_3AD936F26DD3534E FOREIGN KEY (oc_id) REFERENCES oc (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detalle ADD CONSTRAINT FK_80397C30F2E704D7 FOREIGN KEY (compra_id) REFERENCES compra (id)');
        $this->addSql('ALTER TABLE detalle ADD CONSTRAINT FK_80397C3063FB8380 FOREIGN KEY (pago_id) REFERENCES pago (id)');
        $this->addSql('ALTER TABLE distribucion ADD CONSTRAINT FK_698658A7F2E704D7 FOREIGN KEY (compra_id) REFERENCES compra (id)');
        $this->addSql('ALTER TABLE distribucion ADD CONSTRAINT FK_698658A763FB8380 FOREIGN KEY (pago_id) REFERENCES pago (id)');
        $this->addSql('ALTER TABLE pago ADD CONSTRAINT FK_F4DF5F3EDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE pago ADD CONSTRAINT FK_F4DF5F3ECB305D73 FOREIGN KEY (proveedor_id) REFERENCES proveedor (id)');
        $this->addSql('ALTER TABLE pago_solped ADD CONSTRAINT FK_AE54CECE63FB8380 FOREIGN KEY (pago_id) REFERENCES pago (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pago_solped ADD CONSTRAINT FK_AE54CECE1D4EF6B2 FOREIGN KEY (solped_id) REFERENCES solped (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pago_oc ADD CONSTRAINT FK_ABC5B1A563FB8380 FOREIGN KEY (pago_id) REFERENCES pago (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pago_oc ADD CONSTRAINT FK_ABC5B1A56DD3534E FOREIGN KEY (oc_id) REFERENCES oc (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE attachment DROP FOREIGN KEY FK_795FD9BBF2E704D7');
        $this->addSql('ALTER TABLE compra_solped DROP FOREIGN KEY FK_7D8B0A5FF2E704D7');
        $this->addSql('ALTER TABLE compra_oc DROP FOREIGN KEY FK_3AD936F2F2E704D7');
        $this->addSql('ALTER TABLE detalle DROP FOREIGN KEY FK_80397C30F2E704D7');
        $this->addSql('ALTER TABLE distribucion DROP FOREIGN KEY FK_698658A7F2E704D7');
        $this->addSql('ALTER TABLE compra_oc DROP FOREIGN KEY FK_3AD936F26DD3534E');
        $this->addSql('ALTER TABLE pago_oc DROP FOREIGN KEY FK_ABC5B1A56DD3534E');
        $this->addSql('ALTER TABLE attachment DROP FOREIGN KEY FK_795FD9BB63FB8380');
        $this->addSql('ALTER TABLE detalle DROP FOREIGN KEY FK_80397C3063FB8380');
        $this->addSql('ALTER TABLE distribucion DROP FOREIGN KEY FK_698658A763FB8380');
        $this->addSql('ALTER TABLE pago_solped DROP FOREIGN KEY FK_AE54CECE63FB8380');
        $this->addSql('ALTER TABLE pago_oc DROP FOREIGN KEY FK_ABC5B1A563FB8380');
        $this->addSql('ALTER TABLE compra DROP FOREIGN KEY FK_9EC131FFCB305D73');
        $this->addSql('ALTER TABLE pago DROP FOREIGN KEY FK_F4DF5F3ECB305D73');
        $this->addSql('ALTER TABLE compra_solped DROP FOREIGN KEY FK_7D8B0A5F1D4EF6B2');
        $this->addSql('ALTER TABLE pago_solped DROP FOREIGN KEY FK_AE54CECE1D4EF6B2');
        $this->addSql('ALTER TABLE compra DROP FOREIGN KEY FK_9EC131FFDB38439E');
        $this->addSql('ALTER TABLE pago DROP FOREIGN KEY FK_F4DF5F3EDB38439E');
        $this->addSql('DROP TABLE attachment');
        $this->addSql('DROP TABLE compra');
        $this->addSql('DROP TABLE compra_solped');
        $this->addSql('DROP TABLE compra_oc');
        $this->addSql('DROP TABLE detalle');
        $this->addSql('DROP TABLE distribucion');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE oc');
        $this->addSql('DROP TABLE pago');
        $this->addSql('DROP TABLE pago_solped');
        $this->addSql('DROP TABLE pago_oc');
        $this->addSql('DROP TABLE proveedor');
        $this->addSql('DROP TABLE servicios');
        $this->addSql('DROP TABLE solpago');
        $this->addSql('DROP TABLE solped');
        $this->addSql('DROP TABLE usuario');
    }
}
