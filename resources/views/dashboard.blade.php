@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Panel de Administración</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">🧀 <strong>45</strong> Productos</div>
        <div class="bg-white p-6 rounded-lg shadow">🛒 <strong>12</strong> Pedidos hoy</div>
        <div class="bg-white p-6 rounded-lg shadow">👥 <strong>102</strong> Clientes</div>
    </div>
@endsection
