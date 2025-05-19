@extends('layouts.admin')

@section('page-title', 'Pedidos')
@section('page-description', 'Administración de pedidos')
@section('styles')
<script src="https://cdn.tailwindcss.com"></script>
@endsection

@section('content')

<div class="max-w-7xl mx-auto p-4 py-6">

@livewire('pedidos.lista-pedidos')

</div>
@endsection