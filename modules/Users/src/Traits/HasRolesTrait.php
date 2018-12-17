<?php
namespace Users\Traits;

trait HasRolesTrait
{
    /**
     * check if has specific role| check if has one of/all specified roles
     *
     * @param array|string $role
     * @param bool|null $requiredAll
     * @return bool
     */
    public function hasRole($role, ?bool $requiredAll = false): bool
    {
        $hasRole = false;
        if (is_array($role)) {
            foreach ($role as $checkRole) {
                $hasRole = $this->hasRole($checkRole, $requiredAll);
                if ((!$hasRole && $requiredAll) || ($hasRole && !$requiredAll)) {
                    break;
                }
            }
        } elseif (is_string($role)) {
            foreach ($this->roles as $checkRole) {
                if ($checkRole->slug == $role) {
                    $hasRole = true;
                    break;
                }
            }
        }
        return $hasRole;
    }
}