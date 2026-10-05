<?php

class Migration
{
    public static $command = 'migration';

    public static $description = 'Run database migrations';

    public static $arguments = [
        '[action]' => 'Action: run, create-migration, rollback, rollback-all, refresh, status',
        '[name]'   => 'Migration class name for create-migration',
    ];

    protected static $route_map = [
        'run'              => 'migrate',
        'create-migration' => 'create-migration',
        'rollback'         => 'rollback',
        'rollback-all'     => 'rollback-all',
        'refresh'          => 'refresh',
        'status'           => 'status',
    ];

    public function handle($action = null, array $flags = [], $name = null)
    {
        /*
         * If create-migration is being used, the migration name
         * may be passed through the arguments handled by the CLI.
         */
        if ($action === 'create-migration') {

            /*
             * Some LavaLust CLI versions pass positional arguments
             * differently. Check the available arguments.
             */
            if (!$name && isset($flags[0])) {
                $name = $flags[0];
            }

            if (!$name) {
                echo danger("Migration name is required.");
                echo PHP_EOL;
                echo "Example: php lava migration create-migration create_products_table";
                echo PHP_EOL;
                exit(1);
            }

            $route = 'create-migration/' . $name;

        } else {

            $action = $action ?? 'run';

            if (!isset(static::$route_map[$action])) {
                echo danger("Unknown migration action: \"{$action}\"");
                echo PHP_EOL;

                echo "Available actions: "
                    . implode(', ', array_keys(static::$route_map))
                    . PHP_EOL;

                exit(1);
            }

            $route = static::$route_map[$action];
        }

        /*
         * Locate LavaLust public/index.php
         */
        $index = PUBLIC_DIR . 'index.php';

        if (!file_exists($index)) {
            echo danger("index.php not found at: {$index}");
            echo PHP_EOL;
            exit(1);
        }

        /*
         * Execute the requested route
         */
        $command = sprintf(
            'php %s %s',
            escapeshellarg($index),
            escapeshellarg($route)
        );

        passthru($command);
    }
}