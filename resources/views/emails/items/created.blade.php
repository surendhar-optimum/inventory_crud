<x-mail::message>
    <div> Item Created </div>

    <div>
        Name: {{ $item->name }}<br>
        Description: {{ $item->description }}<br>
        Price: {{ $item->price }}<br>
        Quantity: {{ $item->quantity }}<br>
    </div>

    #<x-mail::button :url="''">
        #Button Text
        #</x-mail::button>

    Thanks...<br>
    {{ config('app.name') }}

</x-mail::message>
