<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180223131438 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE distribucion ADD compra_id INT DEFAULT NULL, ADD pago_id INT DEFAULT NULL, ADD tipo TINYINT(1) NOT NULL, ADD ceco VARCHAR(6) NOT NULL, ADD cuenta VARCHAR(6) NOT NULL');
        $this->addSql('ALTER TABLE distribucion ADD CONSTRAINT FK_698658A7F2E704D7 FOREIGN KEY (compra_id) REFERENCES compra (id)');
        $this->addSql('ALTER TABLE distribucion ADD CONSTRAINT FK_698658A763FB8380 FOREIGN KEY (pago_id) REFERENCES pago (id)');
        $this->addSql('CREATE INDEX IDX_698658A7F2E704D7 ON distribucion (compra_id)');
        $this->addSql('CREATE INDEX IDX_698658A763FB8380 ON distribucion (pago_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE distribucion DROP FOREIGN KEY FK_698658A7F2E704D7');
        $this->addSql('ALTER TABLE distribucion DROP FOREIGN KEY FK_698658A763FB8380');
        $this->addSql('DROP INDEX IDX_698658A7F2E704D7 ON distribucion');
        $this->addSql('DROP INDEX IDX_698658A763FB8380 ON distribucion');
        $this->addSql('ALTER TABLE distribucion DROP compra_id, DROP pago_id, DROP tipo, DROP ceco, DROP cuenta');
    }
}
