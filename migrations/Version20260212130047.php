<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260212130047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD is_admin TINYINT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E48644F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E48612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E48697C79677 FOREIGN KEY (fuel_id) REFERENCES fuel (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E48678D28519 FOREIGN KEY (transmission_id) REFERENCES vehicle_transmission (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E4866BF700BD FOREIGN KEY (status_id) REFERENCES vehicle_status (id)');
        $this->addSql('ALTER TABLE vehicle_image ADD CONSTRAINT FK_A79284B3545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP is_admin');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E48644F5D008');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E48612469DE2');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E48697C79677');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E48678D28519');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E4866BF700BD');
        $this->addSql('ALTER TABLE vehicle_image DROP FOREIGN KEY FK_A79284B3545317D1');
    }
}
