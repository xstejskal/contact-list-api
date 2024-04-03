<?php

declare(strict_types=1);

namespace App\Presenters;

use Graphpinator\Nette\ApiPresenter;


final class HomePresenter extends ApiPresenter
{

    protected function getEnabledModules() : \Graphpinator\Module\ModuleSet
    {
        return new \Graphpinator\Module\ModuleSet([
            //new \Graphpinator\QueryCost\MaxDepthModule(15),
            //new \Graphpinator\PersistedQueries\PersistedQueriesModule($schema, $this->cache),
        ]);
    }
}
