@extends('layouts.mantis')
@section('content')
<div class="class">
    <div class="card-header">
        <h1 class="card-title">Detail Bagian {{ $bagian->nama_bagian }}</h1>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Nama Pegawai</th>
                    <th>Email</th>
                    <th>Jenis kelamin</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bagian->pegawai as $index => $item)
                <tr></tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_pegawai }}</td>
                    <td>{{ $item->user->email }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection