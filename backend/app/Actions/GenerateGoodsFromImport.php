<?php

namespace App\Actions;

use App\Models\Goods;
use App\Models\Import;
use Exception;
use Illuminate\Support\Facades\DB;

class GenerateGoodsFromImport
{
    public function handle(Import $import)
    {
        try {
            DB::beginTransaction();

            $importDetail = $import->load('categories');

            $goods = [];

            foreach ($importDetail->categories as $detail) {

                for ($i = 0; $i < $detail->pivot->amount; $i++) {

                    $goods[] = [
                        'category_id' => $detail->getKey(),
                        'import_id' => $import->getKey(),
                    ];
                }
            }

            $status = (bool) Goods::query()->insertOrIgnore($goods);

            DB::commit();

            return $status;
        } catch (Exception $exception) {
            DB::rollback();

            throw $exception;
        }
    }
}