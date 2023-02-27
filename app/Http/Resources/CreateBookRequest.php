<?php

namespace App\Http\Resources;

use App\Rules\NoHtmlJs;
use App\Rules\NoUrls;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateBookRequest extends JsonResource
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:1', 'max:255'],
            'description' => ['sometimes', 'nullable'],
            'link' => ['sometimes', 'nullable', 'max:255']
        ];
    }
}
