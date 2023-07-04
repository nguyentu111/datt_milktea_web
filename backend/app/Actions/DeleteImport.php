<?php

namespace App\Actions;

use App\Models\Goods;
use App\Models\Import;
use Exception;
use Illuminate\Support\Facades\DB;

class DeleteImport
{
    public function handle(Import $import)
    {
        try {
            DB::beginTransaction();

            Goods::query()->where('import_id', $import->getKey())->delete();

            $status = $import->delete();

            DB::commit();

            return $status;
        } catch (Exception $exception) {
            DB::rollback();

            throw $exception;
        }
    }
}