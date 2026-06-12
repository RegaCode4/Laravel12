@extends('layouts.mantis')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">
                    Form Data Pegawai
                </h4>
                <div>
                    <a href="{{ route('pegawai.index') }}">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group my-2">
                        <label for="nama_pegawai">Nama Pegawai</label>
                        <input type="text" name="nama_pegawai" id="nama_pegawai"
                            class="form-control @error('nama_pegawai') 
                        is-invalid @enderror"
                            value="{{ old('nama_pegawai') }}" autofocus>
                        @error('nama_pegawai')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="bagian_id">Bagian</label>
                        <select name="bagian_id" id="bagian_id"
                            class="form-control @error('bagian_id') 
                        is-invalid @enderror">
                            <option value="">Pilih bagian</option>
                            @foreach ($bagians as $bagian)
                                <option value="{{ $bagian->id }}" {{ old('bagian_id') == $bagian->id ? 'selected' : '' }}>
                                    {{ $bagian->nama_bagian }}</option>
                            @endforeach
                        </select>
                        @error('bagian_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email"
                            class="form-control @error('email') 
                        is-invalid @enderror"
                            value="{{ old('email') }}" autocomplete="off">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="nik">NIK</label>
                        <input type="text" name="nik" id="nik"
                            class="form-control @error('nik') 
                        is-invalid @enderror"
                            value="{{ old('nik') }}">
                        @error('nik')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="umur">Umur</label>
                        <input type="number" name="umur" id="umur"
                            class="form-control @error('umur') 
                        is-invalid @enderror"
                            value="{{ old('umur') }}">
                        @error('umur')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin"
                            class="form-control @error('jenis_kelamin') 
                        is-invalid @enderror">
                            <option value="">Pilih jenis kelamin</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                            </option>
                        </select>
                        @error('jenis_kelamin')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                            class="form-control @error('tanggal_lahir') 
                        is-invalid @enderror"
                            value="{{ old('tanggal_lahir') }}">
                        @error('tanggal_lahir')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir"
                            class="form-control @error('tempat_lahir') 
                        is-invalid @enderror"
                            value="{{ old('tempat_lahir') }}">
                        @error('tempat_lahir')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="foto">Foto pegawai</label>
                        <input type="file" name="foto" id="foto"
                            class="form-control @error('foto') 
                        is-invalid @enderror">
                        @error('foto')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat"
                            class="form-control @error('alamat') 
                        is-invalid @enderror">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="my-2 d-flex justify-content-end ">
                        <button class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
