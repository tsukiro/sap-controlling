<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180205210620 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaccion DROP FOREIGN KEY FK_BFF96AF7DB38439E');
        $this->addSql('DROP INDEX IDX_BFF96AF7DB38439E ON transaccion');
        $this->addSql('ALTER TABLE transaccion ADD estado INT NOT NULL, ADD fecha DATETIME NOT NULL, DROP usuario_id');
        $this->addSql('ALTER TABLE compra ADD estado INT NOT NULL, ADD fecha DATETIME NOT NULL');
        $this->addSql('ALTER TABLE pago ADD estado INT NOT NULL, ADD fecha DATETIME NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compra DROP estado, DROP fecha');
        $this->addSql('ALTER TABLE pago DROP estado, DROP fecha');
        $this->addSql('ALTER TABLE transaccion ADD usuario_id INT DEFAULT NULL, DROP estado, DROP fecha');
        $this->addSql('ALTER TABLE transaccion ADD CONSTRAINT FK_BFF96AF7DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_BFF96AF7DB38439E ON transaccion (usuario_id)');
    }
}
