<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191228223450 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE item (id INT NOT NULL, name VARCHAR(100) NOT NULL, price NUMERIC(8, 2) NOT NULL, PRIMARY KEY(id))');

        $this->addSql("INSERT INTO item (id, name, price) VALUES(nextval('item_id_seq'), 'Bike', '150.00') ");
        $this->addSql("INSERT INTO item (id, name, price) VALUES(nextval('item_id_seq'), 'Car', '2500.00') ");
        $this->addSql("INSERT INTO item (id, name, price) VALUES(nextval('item_id_seq'), 'Ute', '1650.00') ");
        $this->addSql("INSERT INTO item (id, name, price) VALUES(nextval('item_id_seq'), 'Computer', '125.00') ");
        $this->addSql("INSERT INTO item (id, name, price) VALUES(nextval('item_id_seq'), 'Television', '150.00') ");
        $this->addSql("INSERT INTO item (id, name, price) VALUES(nextval('item_id_seq'), 'Books', '10.00') ");
        $this->addSql("INSERT INTO item (id, name, price) VALUES(nextval('item_id_seq'), 'Guitar', '650.00') ");
        $this->addSql("INSERT INTO item (id, name, price) VALUES(nextval('item_id_seq'), 'Shoes', '5.00') ");
        $this->addSql("INSERT INTO item (id, name, price) VALUES(nextval('item_id_seq'), 'Telephone', '20.00') ");
        $this->addSql("INSERT INTO item (id, name, price) VALUES(nextval('item_id_seq'), 'Treadmill', '450.00') ");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE item_id_seq CASCADE');
        $this->addSql('DROP TABLE item');
    }
}
