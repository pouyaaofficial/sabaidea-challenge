<?php

namespace Core\Database;

class Migration
{
    public static function migrate(): void
    {
        static::migrationCommand('up');
    }

    public static function rollbackAll(): void
    {
        static::migrationCommand('down');
    }

    public static function fresh(): void
    {
        static::rollbackAll();
        static::migrate();
    }

    private static function migrationCommand(string $command)
    {
        $migrations = glob(getcwd().'/../database/migrations/*.php');

        if ('down' == $command) {
            $migrations = array_reverse($migrations);
        }

        foreach ($migrations as $migration) {
            require_once $migration;
            $migration = pathinfo($migration, PATHINFO_FILENAME);
            $migration = preg_replace('/[0-9]+\-/', '', $migration);
            $migration = str_replace('-', '', ucwords($migration, '-'));
            $migration = "Database\\Migrations\\$migration";
            $ddl = (new $migration())->{$command}();
            db()->query($ddl);
        }
    }
}
