<?php

declare(strict_types=1);

namespace LaminasFriends\Mvc\User\Doctrine\Orm\Options;

use LaminasFriends\Mvc\User\Doctrine\Orm\Entity\User;
use LaminasFriends\Mvc\User\Options\ModuleOptions as BaseModuleOptions;

/**
 * Class ModuleOptions
 */
class ModuleOptions extends BaseModuleOptions
{
    /**
     * @var string
     */
    protected string $userEntityClass = User::class;

    /**
     * @var bool
     */
    protected bool $enableDefaultEntities = true;

    /**
     * @param bool $enableDefaultEntities
     *
     * @return void
     */
    public function setEnableDefaultEntities(bool $enableDefaultEntities): void
    {
        $this->enableDefaultEntities = $enableDefaultEntities;
    }

    /**
     * @return bool
     */
    public function getEnableDefaultEntities(): bool
    {
        return $this->enableDefaultEntities;
    }
}
