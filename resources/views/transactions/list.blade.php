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
    <h1>Transaction List</h1>
    <a href="{!! URL::to('transaction/create') !!}">Create</a>
    <?php $totalSumm = 0 ?>
    <table>
        <thead>
            <tr>
                <td>Micex Code</td>
                <td>Count</td>
                <td>Price</td>
                <td>Summ</td>
                <td>Date</td>
            </tr>
        </thead>
        <tbody>
        @foreach($transactions->all() as $transaction)
            <tr>
                <td class="col-md-1">{!! $transaction->stock->rbk_code !!}</td>
                <td class="col-md-1">{!! $transaction->s_count !!}</td>
                <td class="col-md-1">{!! $transaction->price !!}</td>
                <td class="col-md-1">{!! $transaction->summ !!}</td>
                <td class="col-md-1">{!! $transaction->trans_date !!}</td>
                <?php $totalSumm += $transaction->summ ?>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="row">
        Total: {!! $totalSumm !!}
    </div>
@stop
