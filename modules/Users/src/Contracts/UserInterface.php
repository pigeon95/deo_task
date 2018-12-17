<?php
namespace Users\Contracts;

interface UserInterface
{

    /**
     * get all user's roles
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles();

    /**
     * check if has specific role| check if has one of/all specified roles
     *
     * @param array|string $role
     * @param bool|null $requiredAll
     * @return bool
     */
    public function hasRole($role, ?bool $requiredAll = false): bool;

    /**
     * return user id
     *
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * return user status
     *
     * @return int|null
     */
    public function getStatus(): ?int;

    /**
     * return name of user's status
     *
     * @return null|string
     */
    public function getStatusName(): ?string;

    /**
     * soft delete user with status field
     *
     * @return bool|null
     */
}