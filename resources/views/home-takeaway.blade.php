@extends('layouts.takeaway')

@section('title', 'Takeaway Home')

@section('content')
    @livewire('MenuComponent')

    @livewire('RyanEatTakeawayCartIcon')
@endsection
