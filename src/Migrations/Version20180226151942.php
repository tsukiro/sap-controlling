<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180226151942 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE attachment (id INT AUTO_INCREMENT NOT NULL, compra_id INT DEFAULT NULL, pago_id INT DEFAULT NULL, brochure VARCHAR(255) NOT NULL, created DATETIME NOT NULL, INDEX IDX_795FD9BBF2E704D7 (compra_id), INDEX IDX_795FD9BB63FB8380 (pago_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attachment ADD CONSTRAINT FK_795FD9BBF2E704D7 FOREIGN KEY (compra_id) REFERENCES compra (id)');
        $this->addSql('ALTER TABLE attachment ADD CONSTRAINT FK_795FD9BB63FB8380 FOREIGN KEY (pago_id) REFERENCES pago (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE attachment');
    }
}
