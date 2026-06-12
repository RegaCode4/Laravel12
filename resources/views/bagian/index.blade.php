@extends('layouts.mantis')
@section('content')
<div class="class">
    <div class="card-header">
        <h1 class="card-title">Daftar Bagian</h1>
    </div>
    <div class="div card-body">
        <table class="table">
            <thead class="tr th"></thead>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Bagian</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bagian as $index => $bagian)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $bagian->nama_bagian }}</td>
                    <td>
                        <a href="{{ route('bagian.show', $bagian->id) }}">Detail</a>
                    </td>
                </tr>
                @endforeach
        </table>
    </div>
</div>
@endsection