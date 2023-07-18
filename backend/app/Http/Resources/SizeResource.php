<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SizeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->whenPivotLoaded('drink_sizes', function () {
                $productPrice = Product::find($this->pivot->drink_id)->currentExportPrice();
                $priceUp = floatval($this->pivot->price_up_percent);
                return  round((($productPrice * $priceUp) - $productPrice), -3);
            })
        ];
    }
}
