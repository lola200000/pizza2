<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251218230849 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pizza CHANGE name name VARCHAR(255) NOT NULL, CHANGE description description LONGTEXT NOT NULL, CHANGE image image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE body body LONGTEXT NOT NULL, CHANGE headers headers LONGTEXT NOT NULL, CHANGE queue_name queue_name VARCHAR(190) NOT NULL, CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE messenger_messages CHANGE body body LONGTEXT NOT NULL COLLATE `utf8mb4_uca1400_ai_ci`, CHANGE headers headers LONGTEXT NOT NULL COLLATE `utf8mb4_uca1400_ai_ci`, CHANGE queue_name queue_name VARCHAR(190) NOT NULL COLLATE `utf8mb4_uca1400_ai_ci`, CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE pizza CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_uca1400_ai_ci`, CHANGE description description LONGTEXT NOT NULL COLLATE `utf8mb4_uca1400_ai_ci`, CHANGE image image VARCHAR(255) NOT NULL COLLATE `utf8mb4_uca1400_ai_ci`');
    }
}
