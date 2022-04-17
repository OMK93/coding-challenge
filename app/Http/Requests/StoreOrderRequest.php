<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Rules\ProductInStock;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    public function prepareForValidation()
    {
        $requestProducts = collect($this->products);
        $ids = $requestProducts->pluck('id')->toArray();

        $products = Product::with(['ingredients'])
            ->whereIn('id', $ids)
            ->get()
            ->each(function ($product) use ($requestProducts) {
                $product->qty = $requestProducts->firstWhere('id', $product->id)['qty'];
            })->toArray();

        $this->merge([
            'products' => $products
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'products' => ['array', 'min:1']
        ];

        foreach ($this->products as $key => $product) {
            $rules["products.{$key}.qty"] = ['integer', 'min:1', new ProductInStock($product['id'])];
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'products.min' => "Please add 1 product at least."
        ];

        foreach ($this->products as $key => $product) {
            $messages["products.{$key}.qty.min"] = "{$product['name']} quantity cannot be less than 1";
        }

        return $messages;
    }
}
