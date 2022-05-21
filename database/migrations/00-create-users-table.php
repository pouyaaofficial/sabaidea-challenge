<?php

namespace Database\Migrations;

use Core\Database\MigrationInterface;

class CreateUsersTable implements MigrationInterface
{
    public function up()
    {
        return <<<'SQL'
          CREATE TABLE IF NOT EXISTS `users` (
            `id` INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
            `email` VARCHAR(64) NOT NULL,
            `password` TEXT NOT NULL,
            `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            UNIQUE (`email`)
          )ENGINE=innodb;
        SQL;
    }

    public function down()
    {
        return <<<'SQL'
          DROP TABLE IF EXISTS users
        SQL;
    }
}
