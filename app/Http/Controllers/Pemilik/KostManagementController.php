<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use App\Models\Kamar;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class KostManagementController extends Controller
{
    public function index()
    {
        $kosts = Kost::where('id_user', auth()->id())
            ->withCount('kamars')
            ->latest()
            ->get();

        return view('pemilik.kost.index', compact('kosts'));
    }

    public function create()
    {
        return view('pemilik.kost.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kost' => 'required|string|max:150',
            'alamat_kost' => 'required|string',
            'jenis_kost' => 'required|in:putra,putri,campur',
            'deskripsi_kost' => 'nullable|string',
            'foto_kost' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('foto_kost');
        $data['id_user'] = auth()->id();

        if ($request->hasFile('foto_kost')) {
            $file = $request->file('foto_kost');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kost'), $filename);
            $data['foto_kost'] = $filename;
        }

        Kost::create($data);

        return redirect()->route('pemilik.kost.index')->with('success', 'Kost berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kost = Kost::where('id_user', auth()->id())->findOrFail($id);
        return view('pemilik.kost.edit', compact('kost'));
    }

    public function update(Request $request, $id)
    {
        $kost = Kost::where('id_user', auth()->id())->findOrFail($id);

        $request->validate([
            'nama_kost' => 'required|string|max:150',
            'alamat_kost' => 'required|string',
            'jenis_kost' => 'required|in:putra,putri,campur',
            'deskripsi_kost' => 'nullable|string',
            'foto_kost' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('foto_kost');

        if ($request->hasFile('foto_kost')) {
            $file = $request->file('foto_kost');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kost'), $filename);
            $data['foto_kost'] = $filename;
        }

        $kost->update($data);

        return redirect()->route('pemilik.kost.index')->with('success', 'Kost berhasil diupdate!');
    }

    public function destroy($id)
    {
        $kost = Kost::where('id_user', auth()->id())->findOrFail($id);
        $kost->delete();

        return redirect()->route('pemilik.kost.index')->with('success', 'Kost berhasil dihapus!');
    }

    // Kamar Management
    public function kamars($kostId)
    {
        $kost = Kost::where('id_user', auth()->id())->findOrFail($kostId);
        $kamars = $kost->kamars;

        return view('pemilik.kamar.index', compact('kost', 'kamars'));
    }

    public function createKamar($kostId)
    {
        $kost = Kost::where('id_user', auth()->id())->findOrFail($kostId);
        return view('pemilik.kamar.create', compact('kost'));
    }

    public function storeKamar(Request $request, $kostId)
    {
        $request->validate([
            'tipe_kamar' => 'required|string|max:100',
            'jumlah_kamar' => 'required|integer|min:1',
            'harga_kamar' => 'required|numeric|min:0',
            'status_kamar' => 'required|in:tersedia,terisi',
            'deskripsi_kamar' => 'nullable|string',
            'foto_kamar' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('foto_kamar');
        $data['id_kost'] = $kostId;

        if ($request->hasFile('foto_kamar')) {
            $file = $request->file('foto_kamar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kamar'), $filename);
            $data['foto_kamar'] = $filename;
        }

        Kamar::create($data);

        return redirect()->route('pemilik.kost.kamars', $kostId)->with('success', 'Kamar berhasil ditambahkan!');
    }

    public function editKamar($kostId, $kamarId)
    {
        $kost = Kost::where('id_user', auth()->id())->findOrFail($kostId);
        $kamar = Kamar::where('id_kost', $kostId)->findOrFail($kamarId);

        return view('pemilik.kamar.edit', compact('kost', 'kamar'));
    }

    public function updateKamar(Request $request, $kostId, $kamarId)
    {
        $kamar = Kamar::where('id_kost', $kostId)->findOrFail($kamarId);

        $request->validate([
            'tipe_kamar' => 'required|string|max:100',
            'jumlah_kamar' => 'required|integer|min:1',
            'harga_kamar' => 'required|numeric|min:0',
            'status_kamar' => 'required|in:tersedia,terisi',
            'deskripsi_kamar' => 'nullable|string',
            'foto_kamar' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('foto_kamar');

        if ($request->hasFile('foto_kamar')) {
            $file = $request->file('foto_kamar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kamar'), $filename);
            $data['foto_kamar'] = $filename;
        }

        $kamar->update($data);

        return redirect()->route('pemilik.kost.kamars', $kostId)->with('success', 'Kamar berhasil diupdate!');
    }

    public function destroyKamar($kostId, $kamarId)
    {
        $kamar = Kamar::where('id_kost', $kostId)->findOrFail($kamarId);
        $kamar->delete();

        return redirect()->route('pemilik.kost.kamars', $kostId)->with('success', 'Kamar berhasil dihapus!');
    }

    // Fasilitas Management
    public function fasilitas($kostId)
    {
        $kost = Kost::where('id_user', auth()->id())->findOrFail($kostId);
        $fasilitas = $kost->fasilitas;

        return view('pemilik.fasilitas.index', compact('kost', 'fasilitas'));
    }

    public function createFasilitas($kostId)
    {
        $kost = Kost::where('id_user', auth()->id())->findOrFail($kostId);
        return view('pemilik.fasilitas.create', compact('kost'));
    }

    public function storeFasilitas(Request $request, $kostId)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:100',
            'icon' => 'nullable|string|max:50',
            'deskripsi_fasilitas' => 'nullable|string',
        ]);

        Fasilitas::create([
            'id_kost' => $kostId,
            'nama_fasilitas' => $request->nama_fasilitas,
            'icon' => $request->icon,
            'deskripsi_fasilitas' => $request->deskripsi_fasilitas,
        ]);

        return redirect()->route('pemilik.kost.fasilitas', $kostId)->with('success', 'Fasilitas berhasil ditambahkan!');
    }

    public function destroyFasilitas($kostId, $fasilitasId)
    {
        $fasilitas = Fasilitas::where('id_kost', $kostId)->findOrFail($fasilitasId);
        $fasilitas->delete();

        return redirect()->route('pemilik.kost.fasilitas', $kostId)->with('success', 'Fasilitas berhasil dihapus!');
    }
}