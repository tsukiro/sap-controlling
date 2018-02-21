<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180221031138 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE detalle ADD pago_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detalle ADD CONSTRAINT FK_80397C3063FB8380 FOREIGN KEY (pago_id) REFERENCES pago (id)');
        $this->addSql('CREATE INDEX IDX_80397C3063FB8380 ON detalle (pago_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE detalle DROP FOREIGN KEY FK_80397C3063FB8380');
        $this->addSql('DROP INDEX IDX_80397C3063FB8380 ON detalle');
        $this->addSql('ALTER TABLE detalle DROP pago_id');
    }
}
