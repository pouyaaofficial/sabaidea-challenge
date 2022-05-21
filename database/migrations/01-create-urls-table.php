<?php

namespace Database\Migrations;

use Core\Database\MigrationInterface;

class CreateUrlsTable implements MigrationInterface
{
    public function up()
    {
        return <<<'SQL'
          CREATE TABLE IF NOT EXISTS `urls` (
            `hash` VARCHAR(8) NOT NULL PRIMARY KEY,
            `user_id` INTEGER UNSIGNED NOT NULL,
            `url` TEXT NOT NULL,
            `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            UNIQUE(`hash`),
            FOREIGN KEY (`user_id`) REFERENCES users(id) ON DELETE CASCADE
          )ENGINE=innodb;
        SQL;
    }

    public function down()
    {
        return <<<'SQL'
          DROP TABLE IF EXISTS urls
        SQL;
    }
}
