<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190506135342 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE available_spot (id INT AUTO_INCREMENT NOT NULL, parking_id INT DEFAULT NULL, place_id INT DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, date_start DATE DEFAULT NULL, date_end DATE DEFAULT NULL, time_start TIME DEFAULT NULL, time_end TIME DEFAULT NULL, INDEX IDX_6601AFC9F17B2DD (parking_id), INDEX IDX_6601AFC9DA6A219 (place_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE available_spot ADD CONSTRAINT FK_6601AFC9F17B2DD FOREIGN KEY (parking_id) REFERENCES parking (id)');
        $this->addSql('ALTER TABLE available_spot ADD CONSTRAINT FK_6601AFC9DA6A219 FOREIGN KEY (place_id) REFERENCES place (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE available_spot');
    }
}
