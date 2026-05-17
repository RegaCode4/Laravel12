<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::all();
        return view('pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function store(Request $request){
        //dd($request->all());
        $request->validate([
            'nama_pegawai' => 'required',
            'nik' => 'required|numeric|unique:pegawais',
            'alamat' => 'required',
            'umur' => 'required|numeric',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ],[
            'nama_pegawai.required' => 'Nama pegawai harus diisi',
            'nik.required' => 'NIK harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'umur.required' => 'Umur harus diisi',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'tempat_lahir.required' => 'Tempat lahir harus diisi',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih',
        ]);

        // Pegawai::create([
        //     'nama_pegawai' => $request->nama_pegawai,
        //     'nik' => $request->nik,
        //     'alamat' => $request->alamat,
        //     'umur' => $request->umur,
        //     'tanggal_lahir' => $request->tanggal_lahir,
        //     'tempat_lahir' => $request->tempat_lahir,
        //     'jenis_kelamin' => $request->jenis_kelamin,
        // ]);

        Pegawai::create($request->all());
        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan');
    }

    public function edit(String $id)
    {
        $pegawai = Pegawai::find($id);
        return view('pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'nama_pegawai' => 'required',
            'nik' => 'required|numeric|unique:pegawais,nik,' . $pegawai->id,
            'alamat' => 'required',
            'umur' => 'required|numeric',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ],[
            'nama_pegawai.required' => 'Nama pegawai harus diisi',
            'nik.required' => 'NIK harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'umur.required' => 'Umur harus diisi',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'tempat_lahir.required' => 'Tempat lahir harus diisi',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih',
        ]);

        // $pegawai->update($request->all());

        // menghindari injection
        // $pegawai->update([
        //     'nama_pegawai' => $request->nama_pegawai,
        //     'alamat' => $request->alamat,
        //     'umur' => $request->umur,
        //     'tanggal_lahir' => $request->tanggal_lahir,
        //     'tempat_lahir' => $request->tempat_lahir,
        //     'jenis_kelamin' => $request->jenis_kelamin,
        // ]);

        $pegawai->update($request->except('nik'));

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui');
    }

    public function destroy(String $id)
    {
        Pegawai::destroy($id);
        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil dihapus');
    }
}
