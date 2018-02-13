<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180213182404 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE compra_solped (compra_id INT NOT NULL, solped_id INT NOT NULL, INDEX IDX_7D8B0A5FF2E704D7 (compra_id), INDEX IDX_7D8B0A5F1D4EF6B2 (solped_id), PRIMARY KEY(compra_id, solped_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compra_oc (compra_id INT NOT NULL, oc_id INT NOT NULL, INDEX IDX_3AD936F2F2E704D7 (compra_id), INDEX IDX_3AD936F26DD3534E (oc_id), PRIMARY KEY(compra_id, oc_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE compra_solped ADD CONSTRAINT FK_7D8B0A5FF2E704D7 FOREIGN KEY (compra_id) REFERENCES compra (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compra_solped ADD CONSTRAINT FK_7D8B0A5F1D4EF6B2 FOREIGN KEY (solped_id) REFERENCES solped (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compra_oc ADD CONSTRAINT FK_3AD936F2F2E704D7 FOREIGN KEY (compra_id) REFERENCES compra (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compra_oc ADD CONSTRAINT FK_3AD936F26DD3534E FOREIGN KEY (oc_id) REFERENCES oc (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE compra_solped');
        $this->addSql('DROP TABLE compra_oc');
    }
}
