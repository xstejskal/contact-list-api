<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;

        $router->addRoute('/schema.graphql', [
            'module' => 'Graphpinator',
            'presenter' => 'Schema',
            'action' => 'html',
        ]);

        $router->addRoute('/graphiql', [
            'module' => 'Graphpinator',
            'presenter' => 'GraphiQl',
            'action' => 'default',
        ]);

		$router->addRoute('<presenter>/<action>[/<id>]', 'Home:default');

		return $router;
	}
}
