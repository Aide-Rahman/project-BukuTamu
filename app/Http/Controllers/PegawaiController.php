<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Pegawai;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PegawaiController extends Controller
{
    public function index(): View
    {
        $pegawai = Pegawai::query()
            ->with('divisi')
            ->orderBy('NAMA_PEGAWAI')
            ->get();

        return view('pegawai.index', compact('pegawai'));
    }

    public function create(): View
    {
        $divisi = Divisi::query()->orderBy('NAMA_DIVISI')->get();

        return view('pegawai.create', compact('divisi'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ID_PEGAWAI' => ['required', 'string', 'max:10'],
            'ID_DIVISI' => ['required', 'string', 'max:10', 'exists:divisi,ID_DIVISI'],
            'NIP' => ['required', 'string', 'max:20'],
            'NAMA_PEGAWAI' => ['required', 'string', 'max:100'],
            'JABATAN' => ['nullable', 'string', 'max:30'],
            'EMAIL_KANTOR' => ['nullable', 'string', 'max:50'],
        ]);

        Pegawai::create($validated);

        return to_route('pegawai.index')->with('status', 'Pegawai berhasil ditambahkan.');
    }

    public function edit(Pegawai $pegawai): View
    {
        $pegawai->load('divisi');
        $divisi = Divisi::query()->orderBy('NAMA_DIVISI')->get();

        return view('pegawai.edit', compact('pegawai', 'divisi'));
    }

    public function update(Request $request, Pegawai $pegawai): RedirectResponse
    {
        $validated = $request->validate([
            'ID_DIVISI' => ['required', 'string', 'max:10', 'exists:divisi,ID_DIVISI'],
            'NIP' => ['required', 'string', 'max:20'],
            'NAMA_PEGAWAI' => ['required', 'string', 'max:100'],
            'JABATAN' => ['nullable', 'string', 'max:30'],
            'EMAIL_KANTOR' => ['nullable', 'string', 'max:50'],
        ]);

        $pegawai->update($validated);

        return to_route('pegawai.index')->with('status', 'Pegawai berhasil diperbarui.');
    }

    public function destroy(Pegawai $pegawai): RedirectResponse
    {
        try {
            $pegawai->delete();
        } catch (QueryException $e) {
            return back()->with('error', 'Pegawai tidak bisa dihapus karena masih dipakai pada data lain.');
        }

        return to_route('pegawai.index')->with('status', 'Pegawai berhasil dihapus.');
    }
}
