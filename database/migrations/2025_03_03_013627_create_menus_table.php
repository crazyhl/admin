<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false)->default('')->comment('名称');
            $table->string('url')->nullable(false)->default('')->comment('对应前端路由 url，如果有一天从后端传递路由了，就使用这个作为 url 传递');
            $table->string('permission_name')->nullable(false)->default('')->comment('权限名称，这个也是跟前端对应的');
            $table->tinyInteger('sort')->nullable(false)->default(0)->comment('菜单顺序，预埋的，后端传递路由会使用');
            $table->string('icon')->nullable(false)->default('')->comment('图标的名称字符串，预埋的，后端传递路由会使用');
            $table->string('type')->nullable(false)->default('')->string('菜单类型，1 目录 2 菜单 3 页内按钮');
            $table->bigInteger('parent_id')->nullable(false)->default(0)->comment('上级菜单 id');
            $table->tinyInteger('open_status')->nullable(false)->default(0)->comment('开启方式，0 网页标签 1 新窗口');
            $table->tinyInteger('status')->nullable(false)->default(0)->comment('状态 1 启用 0 关闭');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
