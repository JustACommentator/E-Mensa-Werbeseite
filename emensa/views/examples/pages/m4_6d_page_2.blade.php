@extends('examples.layout.m4_6d_layout')

@section('title', 'Page 2')

@section('data2')
    @foreach($gericht as $meal)
        <li>{{$meal['name']}}</li>
    @endforeach

@endsection

@section('data1')
    @foreach($kategorie as $kat)
        <li>{{$kat['name']}}</li>
    @endforeach
@endsection