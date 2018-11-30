@extends('layouts.main')

@section('title', 'Заказы')

@section('content')
    <div class="container">
        <ul class="nav nav-tabs">
            <li role="presentation" class="{{ $state == 'all' ? 'active' : '' }}"><a href="{{ route('orders')  }}">Заказы</a></li>
            <li role="presentation" class="{{ $state == 'overdue' ? 'active' : '' }}"><a href="{{ route('orders', ['state' => 'overdue'])  }}">Просроченные</a></li>
            <li role="presentation" class="{{ $state == 'current' ? 'active' : '' }}"><a href="{{ route('orders', ['state' => 'current'])  }}">Текущие</a></li>
            <li role="presentation" class="{{ $state == 'new' ? 'active' : '' }}"><a href="{{ route('orders', ['state' => 'new'])  }}">Новые</a></li>
            <li role="presentation" class="{{ $state == 'complite' ? 'active' : '' }}"><a href="{{ route('orders', ['state' => 'complite'])  }}">Выполненные</a></li>
        </ul>
        <section>
        <table class="table table-hover">
            <tbody>
            <tr>
                <th>#</th>
                <th>Партнер</th>
                <th>Стоимость заказа</th>
                <th>Состав заказа</th>
                <th>Статус</th>
                <th>Редактирование</th>
            </tr>
            @php($class = [0 => 'bg-warning', 10 => 'bg-info', 20 => 'bg-success'])
            @foreach($items as $item)
            <tr class="{{ $class[$item->status] }}">
                <td>{{$item->id}}</td>
                <td>{{$item->partner->name}}</td>
                <td>{{ number_format($item->amount, 2, ',', ' ') }}</td>
                <td><ul>@each('_order_items', $item->products, 'item')</ul></td>

                <td style="text-align: center"><span class="label label-info">{{trans( 'order.status.' . $item->status)}}</span></td>
                <td><a href="#" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{ $items->links() }}
        </section>
    </div>
@endsection