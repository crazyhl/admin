<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Models\Role;

class InitAdminAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init-admin-account';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // 创建管理员账号密码，账号密码需要用户输入
        $username = $this->ask(__('Input your super admin username'));
        $password = $this->ask(__('Input your super admin password'));
        $adminUser = new User();
        $adminUser->name = $username;
        $adminUser->email = $username;
        $adminUser->password = bcrypt($password);
        $result = $adminUser->save();
        if (!$result) {
            $this->error(__("Created super admin user fail"));
            return;
        }
        $this->info(__("Created super admin user success"));
        // 生成初始化的角色
        $this->info(__('Create super admin role'));
        $role = Role::findOrCreate('super-admin');
        // 给管理员赋值角色
        $this->info(__("Sync super admin role to admin user"));
        $adminUser->syncRoles($role);
        // 结束
        $this->info(__("Init super admin user success"));
    }
}
