<?php

declare(strict_types=1);

namespace LaminasFriends\Mvc\User\Doctrine\Orm\Mapper;

use Doctrine\ORM\EntityManagerInterface;
use LaminasFriends\Mvc\User\Entity\UserEntityInterface;
use LaminasFriends\Mvc\User\Mapper\UserMapper as MvcUserMapper;
use LaminasFriends\Mvc\User\Doctrine\Orm\Options\ModuleOptions;
use Laminas\Hydrator\HydratorInterface;

class User extends MvcUserMapper
{
    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $em;

    /**
     * @var ModuleOptions
     */
    protected ModuleOptions $options;

    public function __construct(EntityManagerInterface $em, ModuleOptions $options)
    {
        $this->em      = $em;
        $this->options = $options;
    }

    public function findByEmail(string $email)
    {
        $er = $this->em->getRepository($this->options->getUserEntityClass());

        return $er->findOneBy(['email' => $email]);
    }

    public function findByUsername(string $username)
    {
        $er = $this->em->getRepository($this->options->getUserEntityClass());

        return $er->findOneBy(['username' => $username]);
    }

    public function findById($id)
    {
        $er = $this->em->getRepository($this->options->getUserEntityClass());

        return $er->find($id);
    }

    public function insert(UserEntityInterface $entity, $tableName = null, HydratorInterface $hydrator = null)
    {
        return $this->persist($entity);
    }

    public function update(UserEntityInterface $entity, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
        return $this->persist($entity);
    }

    /**
     * @param UserEntityInterface $entity
     *
     * @return UserEntityInterface
     */
    protected function persist(UserEntityInterface $entity): UserEntityInterface
    {
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }
}
