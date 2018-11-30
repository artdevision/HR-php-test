<li>{{ $item->name }}<br/>
    <strong>Количество:</strong> <span class="label label-info"> {{ $item->pivot->quantity }} шт </span>&nbsp;|
    <strong>Сумма:</strong> <span class="label label-success"> {{ number_format($item->pivot->price / pow(10, 2), 2, ',', ' ')  }} руб </span>
</li>