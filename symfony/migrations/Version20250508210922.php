<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250508210922 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE company_country (id SERIAL NOT NULL, company_id INT NOT NULL, state JSON NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_7321D3B1979B1AD6 ON company_country (company_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE company_country ADD CONSTRAINT FK_7321D3B1979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE company_country DROP CONSTRAINT FK_7321D3B1979B1AD6
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE company_country
        SQL);
    }
}
