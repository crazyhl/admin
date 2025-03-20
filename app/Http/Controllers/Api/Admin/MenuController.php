<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Menu\MenuStoreRequest;
use App\Http\Requests\Admin\Menu\UpdateMenusRequest;
use App\Models\Menu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * 获取列表
     */
    public function index(Request $request): JsonResponse
    {
        $query = Menu::query();

        // 分页
        $pageSize = $request->input('page_size', 10);
        $list = $query->orderBy('id', 'desc')->paginate($pageSize);

        return apiResponse(0, $list, '获取成功');
    }

    /**
     * 获取单条记录
     */
    public function show(Menu $menu): JsonResponse
    {
        return apiResponse(0, $menu, '获取成功');
    }

    /**
     * 存储新记录
     */
    public function store(MenuStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $menu = Menu::create($validated);

        return apiResponse(0, $menu, '创建成功');
    }

    /**
     * 更新记录
     */
    public function update(UpdateMenusRequest $request, Menu $menu): JsonResponse
    {
        $validated = $request->validated();

        $menu->update($validated);

        return apiResponse(0, $menu, '更新成功');
    }

    /**
     * 删除记录
     */
    public function destroy(Menu $menu): JsonResponse
    {
        $menu->delete();

        return apiResponse(0, null, '删除成功');
    }
}
