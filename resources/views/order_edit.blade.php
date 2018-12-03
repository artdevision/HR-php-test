@extends('layouts.main')

@section('title', 'Заказ №-' . $model->id)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    {{ Form::model($model, ['route' => ['order.edit', $model->id]]) }}
                    <div class="panel-heading"><h3>Редактирование заказа №-{{$model->id}}</h3></div>
                    <div class="panel-body">

                            <div class="form-group{{ $errors->has('client_email') ? ' has-error' : ''}}">
                                {{Form::label('client_email', 'Еmail')}}
                                {{Form::text('client_email', null,  ['class' => 'form-control'])}}
                                @if ($errors->has('client_email'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('client_email') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('partner_id') ? ' has-error' : ''}}">
                                {{Form::label('partner_id', 'Партнер')}}
                                {{ Form::select('partner_id', \App\Partner::selectList(), null, ['class' => 'form-control'])  }}
                                @if ($errors->has('partner_id'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('partner_id') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('status') ? ' has-error' : ''}}">
                                {{Form::label('status', 'Статус')}}
                                <div class="radio">
                                    <label>
                                        {{ Form::radio('status', $model::STATUS_NEW, $model->status === $model::STATUS_NEW) }} {{ trans('order.status.0') }}
                                    </label>
                                    <label>
                                        {{ Form::radio('status', $model::STATUS_CURRENT, $model->status === $model::STATUS_CURRENT) }} {{ trans('order.status.10') }}
                                    </label>
                                    <label>
                                        {{ Form::radio('status', $model::STATUS_DONE, $model->status === $model::STATUS_DONE) }} {{ trans('order.status.20') }}
                                    </label>

                                </div>
                                @if ($errors->has('status'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('status')}}
                                    </div>
                                @endif
                            </div>
                            <h4>Состав заказа</h4>
                            @include('order_products_table', ['model' => $model])


                    </div>
                    <div class="panel-footer text-center">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                        <a href="{{ url()->previous() }}" class="btn btn-default">Отмена</a>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection