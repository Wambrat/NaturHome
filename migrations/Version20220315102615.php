<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220315102615 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipment (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materials_group (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, equipment_id INT NOT NULL, INDEX IDX_7ED7708A4584665A (product_id), INDEX IDX_7ED7708A517FE9FE (equipment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, recipe LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe_element (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, ingredients_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_DA450794584665A (product_id), INDEX IDX_DA450793EC4DCE (ingredients_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE materials_group ADD CONSTRAINT FK_7ED7708A4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE materials_group ADD CONSTRAINT FK_7ED7708A517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id)');
        $this->addSql('ALTER TABLE recipe_element ADD CONSTRAINT FK_DA450794584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE recipe_element ADD CONSTRAINT FK_DA450793EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredient (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE materials_group DROP FOREIGN KEY FK_7ED7708A517FE9FE');
        $this->addSql('ALTER TABLE recipe_element DROP FOREIGN KEY FK_DA450793EC4DCE');
        $this->addSql('ALTER TABLE materials_group DROP FOREIGN KEY FK_7ED7708A4584665A');
        $this->addSql('ALTER TABLE recipe_element DROP FOREIGN KEY FK_DA450794584665A');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE materials_group');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE recipe_element');
    }
}
