<?php
namespace Users\Contracts;

interface LoginRegisterInterface
{
    /**
     * get user
     *
     * @return UserInterface
     */
    public function user();
}