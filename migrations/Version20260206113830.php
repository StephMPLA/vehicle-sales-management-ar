<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260206113830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicle CHANGE brand_id brand_id INT NOT NULL, CHANGE fuel_id fuel_id INT NOT NULL, CHANGE category_id category_id INT NOT NULL, CHANGE transmission_id transmission_id INT NOT NULL, CHANGE status_id status_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicle CHANGE brand_id brand_id INT DEFAULT NULL, CHANGE fuel_id fuel_id INT DEFAULT NULL, CHANGE category_id category_id INT DEFAULT NULL, CHANGE transmission_id transmission_id INT DEFAULT NULL, CHANGE status_id status_id INT DEFAULT NULL');
    }
}
