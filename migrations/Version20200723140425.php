<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200723140425 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE raid CHANGE day_one day_one TINYINT(1) DEFAULT NULL, CHANGE day_two day_two TINYINT(1) DEFAULT NULL, CHANGE day_three day_three TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE raid CHANGE day_one day_one DATETIME DEFAULT NULL, CHANGE day_two day_two DATETIME DEFAULT NULL, CHANGE day_three day_three DATETIME DEFAULT NULL');
    }
}
