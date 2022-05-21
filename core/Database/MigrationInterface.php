<?php

namespace Core\Database;

interface MigrationInterface
{
    public function up();

    public function down();
}
