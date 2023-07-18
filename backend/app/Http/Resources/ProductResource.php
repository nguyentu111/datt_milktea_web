<?php

namespace App\Http\Resources;

use App\Models\ProductExPrice;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'active' => $this->active,
            'toppings' => ToppingResource::collection($this->availableToppings),
            'description' => $this->description,
            'sizes' => SizeResource::collection($this->sizes),
            'tax' => floatval($this->tax->percent),
            'regular_amount' => $this->currentExportPrice(),
            'promotion_amount' => $this->currentPromotionPrice(),
            'picture' => $this->picture,
            'slug' => $this->slug,
        ];
    }
}
