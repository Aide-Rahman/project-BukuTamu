@extends('layout.app')

@section('title', 'Edit Pegawai')

@section('content')
    <div class="d-flex align-items-start justify-content-between mb-3">
        <div>
            <h1 class="h4 mb-1">Edit Pegawai</h1>
            <div class="text-muted">{{ $pegawai->NAMA_PEGAWAI }} ({{ $pegawai->ID_PEGAWAI }})</div>
        </div>
        <a href="{{ route('pegawai.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('pegawai.update', $pegawai) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">ID Pegawai</label>
                        <input value="{{ $pegawai->ID_PEGAWAI }}" class="form-control" disabled>
                    </div>

                    <div class="col-md-8">
                        <label class="form-label">Divisi</label>
                        <select name="ID_DIVISI" class="form-select" required>
                            @foreach ($divisi as $d)
                                <option value="{{ $d->ID_DIVISI }}" @selected(old('ID_DIVISI', $pegawai->ID_DIVISI) == $d->ID_DIVISI)>
                                    {{ $d->NAMA_DIVISI }} ({{ $d->ID_DIVISI }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">NIP</label>
                        <input type="text" name="NIP" value="{{ old('NIP', $pegawai->NIP) }}" class="form-control" required>
                    </div>

                    <div class="col-md-8">
                        <label class="form-label">Nama Pegawai</label>
                        <input type="text" name="NAMA_PEGAWAI" value="{{ old('NAMA_PEGAWAI', $pegawai->NAMA_PEGAWAI) }}" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Jabatan</label>
                        <input type="text" name="JABATAN" value="{{ old('JABATAN', $pegawai->JABATAN) }}" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email Kantor</label>
                        <input type="text" name="EMAIL_KANTOR" value="{{ old('EMAIL_KANTOR', $pegawai->EMAIL_KANTOR) }}" class="form-control">
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
