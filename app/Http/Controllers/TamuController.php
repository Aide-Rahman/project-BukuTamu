<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Pegawai;
use App\Models\Tamu;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TamuController extends Controller
{
    public function index(): View
    {
        $tamu = Tamu::query()
            ->orderBy('NAMA_LENGKAP')
            ->get();

        return view('tamu.index', compact('tamu'));
    }

    public function create(): View
    {
        return view('tamu.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'NIK_TAMU' => ['required', 'string', 'max:16'],
            'NAMA_LENGKAP' => ['required', 'string', 'max:100'],
            'NO_HP' => ['required', 'string', 'max:15'],
            'ASAL_INSTANSI' => ['nullable', 'string', 'max:50'],
            'ALAMAT' => ['nullable', 'string', 'max:100'],
            'JENIS_KELAMIN' => ['required', 'string', 'max:10'],
        ]);

        $validated['ID_TAMU'] = (int) (Tamu::query()->max('ID_TAMU') ?? 0) + 1;

        Tamu::create($validated);

        return to_route('tamu.index')->with('status', 'Tamu berhasil ditambahkan.');
    }

    public function edit(Tamu $tamu): View
    {
        $tamu->load(['kunjungan' => function ($q) {
            $q->with('pegawai')->orderByDesc('WAKTU_CHECKIN');
        }]);

        $pegawai = Pegawai::query()->orderBy('NAMA_PEGAWAI')->get();

        return view('tamu.edit', compact('tamu', 'pegawai'));
    }

    public function update(Request $request, Tamu $tamu): RedirectResponse
    {
        $validated = $request->validate([
            'NIK_TAMU' => ['required', 'string', 'max:16'],
            'NAMA_LENGKAP' => ['required', 'string', 'max:100'],
            'NO_HP' => ['required', 'string', 'max:15'],
            'ASAL_INSTANSI' => ['nullable', 'string', 'max:50'],
            'ALAMAT' => ['nullable', 'string', 'max:100'],
            'JENIS_KELAMIN' => ['required', 'string', 'max:10'],
        ]);

        $tamu->update($validated);

        return to_route('tamu.index')->with('status', 'Tamu berhasil diperbarui.');
    }

    public function destroy(Tamu $tamu): RedirectResponse
    {
        try {
            $tamu->delete();
        } catch (QueryException $e) {
            return back()->with('error', 'Tamu tidak bisa dihapus karena masih punya relasi (kunjungan/agenda).');
        }

        return to_route('tamu.index')->with('status', 'Tamu berhasil dihapus.');
    }

    public function storeKunjungan(Request $request, Tamu $tamu): RedirectResponse
    {
        $validated = $request->validate([
            'ID_KUNJUNGAN' => ['required', 'string', 'max:8'],
            'ID_PEGAWAI' => ['required', 'string', 'max:10', 'exists:pegawai,ID_PEGAWAI'],
            'NO_TIKET' => ['required', 'string', 'max:10'],
            'WAKTU_CHECKIN' => ['nullable', 'date'],
            'WAKTU_CHEKOUT' => ['nullable', 'date'],
            'KEPERLUAN' => ['required', 'string'],
        ]);

        $validated['ID_TAMU'] = $tamu->getAttribute('ID_TAMU');
        $validated['WAKTU_CHECKIN'] = $validated['WAKTU_CHECKIN'] ?? now();

        Kunjungan::create($validated);

        return to_route('tamu.edit', $tamu)->with('status', 'Kunjungan berhasil dicatat.');
    }
}
