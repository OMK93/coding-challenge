@component('mail::message')
Hello {{ $merchantName  }},

We are getting in touch as the Ingredient <strong>{{ $ingredient->name }}</strong> amount
got below 50% of the original stock.

<p>Ingredient strong: <strong>{{ $ingredient->name }}</strong></p>

<p>Ingredient Current Stock: <strong>{{ $ingredient->stock }} {{ $ingredient->unit }}</strong></p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
