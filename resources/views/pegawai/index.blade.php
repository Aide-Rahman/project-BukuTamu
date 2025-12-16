@extends('layout.app')

@section('title', 'Daftar Pegawai')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h4 mb-1">Daftar Pegawai</h1>
            <div class="text-muted">Kelola data pegawai</div>
        </div>
        <a href="{{ route('pegawai.create') }}" class="btn btn-primary">Tambah Pegawai</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>NIP</th>
                        <th>NAMA PEGAWAI</th>
                        <th>JABATAN</th>
                        <th>NAMA DIVISI</th>
                        <th class="text-end">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pegawai as $p)
                        <tr>
                            <td>{{ $p->NIP }}</td>
                            <td>{{ $p->NAMA_PEGAWAI }}</td>
                            <td>{{ $p->JABATAN }}</td>
                            <td>{{ $p->divisi?->NAMA_DIVISI }}</td>
                            <td class="text-end">
                                <a href="{{ route('pegawai.edit', $p) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <form action="{{ route('pegawai.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pegawai ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada data pegawai.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
