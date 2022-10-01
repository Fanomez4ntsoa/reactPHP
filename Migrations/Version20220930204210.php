<?php

declare(strict_types=1);

namespace reactPHP\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220930204210 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
      $sql = <<<SQL
      CREATE TABLE products (
        id INT UNSIGNED AUTO_INCREMENT NOT NULL,
        nom VARCHAR (255) NOT NULL,
        price DECIMAL (10,2) NOT NULL,
        PRIMARY KEY (id)
      )
      SQL;
      $this->addSql($sql);
    }

    public function down(Schema $schema): void
    {
      $this->addSql('DROP TABLE products');
    }
}
