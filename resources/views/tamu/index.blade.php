@extends('layout.app')

@section('title', 'Daftar Tamu')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h4 mb-1">Daftar Tamu</h1>
            <div class="text-muted">Kelola data tamu</div>
        </div>
        <a href="{{ route('tamu.create') }}" class="btn btn-primary">Tambah Tamu Baru</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
                        <th>Asal Instansi</th>
                        <th>No HP</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tamu as $t)
                        <tr>
                            <td>{{ $t->NIK_TAMU }}</td>
                            <td>{{ $t->NAMA_LENGKAP }}</td>
                            <td>{{ $t->ASAL_INSTANSI }}</td>
                            <td>{{ $t->NO_HP }}</td>
                            <td class="text-end">
                                <a href="{{ route('tamu.edit', $t) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <form action="{{ route('tamu.destroy', $t) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus tamu ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada data tamu.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
