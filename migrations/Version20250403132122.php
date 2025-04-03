<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250403132122 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE checklist_item_template (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, template_id INTEGER DEFAULT NULL, label VARCHAR(255) NOT NULL, is_required BOOLEAN NOT NULL, position INTEGER NOT NULL, CONSTRAINT FK_414DF8125DA0FB8 FOREIGN KEY (template_id) REFERENCES checklist_template (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_414DF8125DA0FB8 ON checklist_item_template (template_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE checklist_template (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE project_checklist (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, template_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, client VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
            , username VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_4D5528F85DA0FB8 FOREIGN KEY (template_id) REFERENCES checklist_template (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_4D5528F85DA0FB8 ON project_checklist (template_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE project_checklist_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, label VARCHAR(255) NOT NULL, is_checked BOOLEAN NOT NULL, position INTEGER NOT NULL, CONSTRAINT FK_705C145B166D1F9C FOREIGN KEY (project_id) REFERENCES project_checklist (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_705C145B166D1F9C ON project_checklist_item (project_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
            , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
            , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
            )
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE checklist_item_template
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE checklist_template
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE project_checklist
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE project_checklist_item
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
