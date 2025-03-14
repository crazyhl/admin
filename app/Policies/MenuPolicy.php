<?php

namespace App\Policies;

use App\Models\Menu;
use App\Models\User;

class MenuPolicy
{
    /**
     * 能否创建菜单
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('menu-create') || $user->hasRole('super-admin');
    }

    /**
     * 能否更新菜单
     */
    public function update(User $user): bool
    {
        return $user->hasRole('super-admin') || $user->can('menu-edit');
    }

    /**
     * 能否删除菜单
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        return $user->hasRole('super-admin') || $user->can('menu-delete');
    }

    /**
     * 查看列表
     * @param User $user
     * @return bool
     */
    public function viewList(User $user): bool
    {
        return $user->hasRole('super-admin') || $user->can('menu-view-list');
    }

    /**
     * 查看单项
     * @param User $user
     * @param Menu $menu
     * @return bool
     */
    public function view(User $user, Menu $menu): bool
    {
        return $user->hasRole('super-admin') || $user->can('menu-view-list');
    }
}
