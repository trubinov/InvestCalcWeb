<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 26.03.2016
 * Time: 11:49
 */
?>
@extends('master')
@section('body')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::open(array('action' => 'StockTransactionController@store')) !!}
        {!! Form::text('stock_code') !!}
        {!! Form::number('s_count') !!}
        {!! Form::number('price', null, array('step' => 'any')) !!}
        {!! Form::datetimeLocal('trans_date', \Carbon\Carbon::now()) !!}
        {!! Form::submit() !!}
    {!! Form::close() !!}
    <?php
    $quotes = new \App\InvestCalc\Quotes();
    var_dump($quotes->getQuoteCodesJSON());
    ?>
@stop
