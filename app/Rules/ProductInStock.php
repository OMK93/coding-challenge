<?php

namespace App\Rules;

use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;

class ProductInStock implements Rule
{
    private $product;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($productId)
    {
        $this->product = Product::with('ingredients')->find($productId);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($this->product->ingredients as $ingredient) {
            $requestedAmount = $value * ($ingredient->pivot->qty / 1000);

            if ($requestedAmount > $ingredient->stock) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "insufficient ingredients stock for {$this->product->name}";
    }
}
