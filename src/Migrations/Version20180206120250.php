<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180206120250 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compra ADD usuario_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE compra ADD CONSTRAINT FK_9EC131FFDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_9EC131FFDB38439E ON compra (usuario_id)');
        $this->addSql('ALTER TABLE pago ADD usuario_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pago ADD CONSTRAINT FK_F4DF5F3EDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_F4DF5F3EDB38439E ON pago (usuario_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compra DROP FOREIGN KEY FK_9EC131FFDB38439E');
        $this->addSql('DROP INDEX IDX_9EC131FFDB38439E ON compra');
        $this->addSql('ALTER TABLE compra DROP usuario_id');
        $this->addSql('ALTER TABLE pago DROP FOREIGN KEY FK_F4DF5F3EDB38439E');
        $this->addSql('DROP INDEX IDX_F4DF5F3EDB38439E ON pago');
        $this->addSql('ALTER TABLE pago DROP usuario_id');
    }
}
