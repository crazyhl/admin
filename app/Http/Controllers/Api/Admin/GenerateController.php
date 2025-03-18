<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GenerateController extends Controller
{
    public function allTable(Request $request)
    {
        $tables = DB::select('SHOW TABLES');
        $tableNames = collect($tables)->map(function ($table) {
            return array_values((array)$table)[0];
        })->toArray();

        return apiResponse(0, ['tables' => $tableNames]);
    }

    public function tableSchema(Request $request)
    {
        $tableName = $request->get('tableName');
        if (Schema::hasTable($tableName)) {
            return apiResponse(-1, [], '表不存在');
        }

        // 获取表的所有字段信息
        $columns = DB::select("SHOW FULL COLUMNS FROM {$tableName}");

        // 获取表的基本信息
        $tableInfo = DB::select("SHOW TABLE STATUS WHERE Name = ?", [$tableName])[0];

        return apiResponse(0, [
            'table' => [
                'name' => $tableName,
                'comment' => $tableInfo->Comment ?? '',
                'engine' => $tableInfo->Engine,
                'collation' => $tableInfo->Collation,
            ],
            'columns' => collect($columns)->map(function ($column) {
                return [
                    'field' => $column->Field,
                    'type' => $column->Type,
                    'null' => $column->Null === 'YES',
                    'key' => $column->Key,
                    'default' => $column->Default,
                    'extra' => $column->Extra,
                    'comment' => $column->Comment,
                ];
            })->toArray()
        ]);
    }
}
