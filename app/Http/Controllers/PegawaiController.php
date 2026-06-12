<?php

namespace App\Http\Controllers;

use App\Models\Bagian;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::with('user')->get();
        return view('pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        $bagians = Bagian::all();
        return view('pegawai.create', compact('bagians'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'nama_pegawai' => 'required',
            'bagian_id' => 'required|exists:bagians,id',
            'email' => 'required|email|unique:users,email',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nik' => 'required|numeric|unique:pegawais,nik',
            'alamat' => 'required',
            'umur' => 'required|numeric',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ], [
            'nama_pegawai.required' => 'Nama pegawai harus diisi',
            'bagian_id.required' => 'Bagian harus dipilih',
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

        $foto = $request->file('foto');
        $fileName = Str::uuid() . '.' . $foto->getClientOriginalExtension();

        Storage::disk('public')->putFileAs('foto_pegawai', $foto, $fileName);

        $newRequest = $request->all();
        $newRequest['foto'] = $fileName;

        $newData = Pegawai::create($newRequest);
        $user = User::create([
            'name' => $request->nama_pegawai,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'pegawai_id' => $newData->id,
        ]);
        $newData->user_id = $user->id;
        $newData->save();
        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan');
    }

    public function edit(String $id)
    {
        $pegawai = Pegawai::find($id);
        $bagians = Bagian::all();
        return view('pegawai.edit', compact('pegawai', 'bagians'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'nama_pegawai' => 'required',
            'bagian_id' => 'required|exists:bagians,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nik' => 'required|numeric|unique:pegawais,nik,' . $pegawai->id,
            'alamat' => 'required',
            'umur' => 'required|numeric',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ],[
            'nama_pegawai.required' => 'Nama pegawai harus diisi',
            'bagian_id.required' => 'Bagian harus dipilih',
            'nik.required' => 'NIK harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'umur.required' => 'Umur harus diisi',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'tempat_lahir.required' => 'Tempat lahir harus diisi',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih',
        ]);

        $fileName = $pegawai->foto;
        $foto = $request->file('foto');
        if($foto) {
            $fileName = Str::uuid() . '.' . $foto->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('foto_pegawai', $foto, $fileName);
        } else {
            $fileName = $pegawai->foto;
        }

        $newRequest = $request->except('nik');
        $newRequest['foto'] = $fileName;
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

        $pegawai->update($newRequest);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui');
    }

    public function destroy(String $id)
    {
        //Pegawai::destroy($id);
        $pegawai = Pegawai::find($id);
        if($pegawai->foto) {
            Storage::disk('public')->delete('foto_pegawai/' . $pegawai->foto);
        }
        $pegawai->delete();
        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil dihapus');
    }
}
