<table class="table">
    <tbody>
        <tr>
            <th style="max-width: 50%">Наименование</th>
            <th>Количество</th>
            <th style="text-align: right;">Сумма</th>
        </tr>
        @foreach($model->products as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td style="text-align: center;">{{ $item->pivot->quantity }}</td>
                <td style="min-width: 100px; text-align: right;">{{ number_format($item->pivot->price / pow(10, 2), 2, ',', ' ' )}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2"><strong>Итого:</strong></td>
            <td style="text-align: right;"><strong>{{ number_format($model->amount, 2, ',', ' ' ) }}</strong></td>
        </tr>

    </tbody>
</table>