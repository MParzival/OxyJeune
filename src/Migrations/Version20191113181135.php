<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191113181135 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, id_rate_id INT DEFAULT NULL, id_model_id INT DEFAULT NULL, id_category_id INT DEFAULT NULL, label VARCHAR(100) NOT NULL, is_reservable TINYINT(1) NOT NULL, is_man TINYINT(1) NOT NULL, is_woman TINYINT(1) NOT NULL, is_child TINYINT(1) NOT NULL, is_electric TINYINT(1) NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_D34A04AD620436EF (id_rate_id), INDEX IDX_D34A04AD29AE5B72 (id_model_id), INDEX IDX_D34A04ADA545015 (id_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, postal_code VARCHAR(3) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, id_city_id INT DEFAULT NULL, number VARCHAR(10) NOT NULL, line1 VARCHAR(255) NOT NULL, line2 VARCHAR(255) DEFAULT NULL, line3 VARCHAR(255) DEFAULT NULL, INDEX IDX_D4E6F815531CBDF (id_city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE leasing (id INT AUTO_INCREMENT NOT NULL, id_person_id INT DEFAULT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, rental_time INT NOT NULL, amount_paid INT DEFAULT NULL, amount_deposit INT DEFAULT NULL, INDEX IDX_3B3574F4A14E0760 (id_person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE leasing_product (id INT AUTO_INCREMENT NOT NULL, id_leasing_id INT DEFAULT NULL, id_product_id INT DEFAULT NULL, INDEX IDX_464214D16CE6E601 (id_leasing_id), INDEX IDX_464214D1E00EE68D (id_product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, id_address_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, phone_number VARCHAR(14) NOT NULL, cell_number VARCHAR(14) NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_34DCD176503D2FA2 (id_address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model (id INT AUTO_INCREMENT NOT NULL, id_brand_id INT DEFAULT NULL, label VARCHAR(100) NOT NULL, INDEX IDX_D79572D9142E3C9D (id_brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quote (id INT AUTO_INCREMENT NOT NULL, id_person_id INT DEFAULT NULL, label VARCHAR(100) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, repair_time INT NOT NULL, price_ht NUMERIC(10, 2) NOT NULL, price_tva NUMERIC(10, 2) NOT NULL, body LONGTEXT DEFAULT NULL, INDEX IDX_6B71CBF4A14E0760 (id_person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rate (id INT AUTO_INCREMENT NOT NULL, price INT NOT NULL, half_day_number INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE repair (id INT AUTO_INCREMENT NOT NULL, id_quote_id INT DEFAULT NULL, INDEX IDX_8EE434218B5BBDED (id_quote_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD620436EF FOREIGN KEY (id_rate_id) REFERENCES rate (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD29AE5B72 FOREIGN KEY (id_model_id) REFERENCES model (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA545015 FOREIGN KEY (id_category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F815531CBDF FOREIGN KEY (id_city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE leasing ADD CONSTRAINT FK_3B3574F4A14E0760 FOREIGN KEY (id_person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE leasing_product ADD CONSTRAINT FK_464214D16CE6E601 FOREIGN KEY (id_leasing_id) REFERENCES leasing (id)');
        $this->addSql('ALTER TABLE leasing_product ADD CONSTRAINT FK_464214D1E00EE68D FOREIGN KEY (id_product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176503D2FA2 FOREIGN KEY (id_address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D9142E3C9D FOREIGN KEY (id_brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT FK_6B71CBF4A14E0760 FOREIGN KEY (id_person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE repair ADD CONSTRAINT FK_8EE434218B5BBDED FOREIGN KEY (id_quote_id) REFERENCES quote (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADA545015');
        $this->addSql('ALTER TABLE leasing_product DROP FOREIGN KEY FK_464214D1E00EE68D');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F815531CBDF');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176503D2FA2');
        $this->addSql('ALTER TABLE leasing_product DROP FOREIGN KEY FK_464214D16CE6E601');
        $this->addSql('ALTER TABLE leasing DROP FOREIGN KEY FK_3B3574F4A14E0760');
        $this->addSql('ALTER TABLE quote DROP FOREIGN KEY FK_6B71CBF4A14E0760');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD29AE5B72');
        $this->addSql('ALTER TABLE repair DROP FOREIGN KEY FK_8EE434218B5BBDED');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD620436EF');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D9142E3C9D');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE leasing');
        $this->addSql('DROP TABLE leasing_product');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE model');
        $this->addSql('DROP TABLE quote');
        $this->addSql('DROP TABLE rate');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE repair');
    }
}
