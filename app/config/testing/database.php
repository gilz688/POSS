<?php

return array(
    'default' => 'sqlite',
    'connections' => array(
        'sqlite' => array(
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ),
        'pgsql' => array(
			'driver'   => 'pgsql',
			'host'     => 'localhost',
			'database' => 'poss',
			'username' => 'laravel_poss',
			'password' => 'laravel',
			'charset'  => 'utf8',
			'prefix'   => '',
			'schema'   => 'public',
		),
    ),
);
