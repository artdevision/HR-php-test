@component('mail::message')
    <p>
    Заказ № {{ $order->id }} завершен <br/>

    </p>

    @component('mail::table')
        | Ид            | Наименование  | Кличество| Сумма  |
        | ------------- |:------------- | --------:| ------:|
        @foreach($order->products as $item)
        | {{ $item->id }} | {{ $item->name }} | {{$item->pivot->quantity}} | {{$item->pivot->price / pow(10, 2)}} |
        @endforeach
        | Итого         |               |          | {{ $order->amount }} |
    @endcomponent
@endcomponent