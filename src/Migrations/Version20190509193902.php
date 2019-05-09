<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190509193902 extends AbstractMigration
{
    /**
     * {@inheritDoc}
     */
    public function up(Schema $schema) : void
    {
           $this->addSql('ALTER TABLE user ADD linked_in VARCHAR(255) DEFAULT NULL, CHANGE roles roles JSON NOT NULL, CHANGE password_changed password_changed DATETIME DEFAULT NULL, CHANGE homepage homepage VARCHAR(255) DEFAULT NULL');
    }

    /**
     * {@inheritDoc}
     */
    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE user DROP linked_in, CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin, CHANGE password_changed password_changed DATETIME DEFAULT \'NULL\', CHANGE homepage homepage VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
