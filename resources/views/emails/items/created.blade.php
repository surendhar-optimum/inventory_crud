<x-mail::message>
     # Item Created

<div>
        Name: {{ $item->name }}<br>
        Description: {{ $item->description }}<br>
        Price: {{ $item->price }}<br>
        Quantity: {{ $item->quantity }}<br>
</div>


<br><br>
    Thanks...<br>
    {{ config('app.name') }}

</x-mail::message>
