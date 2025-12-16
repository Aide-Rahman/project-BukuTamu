@extends('layout.app')

@section('title', 'Tambah Pegawai')

@section('content')
    <div class="mb-3">
        <h1 class="h4 mb-1">Tambah Pegawai</h1>
        <div class="text-muted">Isi data pegawai baru</div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('pegawai.store') }}">
                @csrf

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">ID Pegawai</label>
                        <input type="text" name="ID_PEGAWAI" value="{{ old('ID_PEGAWAI') }}" class="form-control" required>
                    </div>

                    <div class="col-md-8">
                        <label class="form-label">Divisi</label>
                        <select name="ID_DIVISI" class="form-select" required>
                            <option value="">-- pilih divisi --</option>
                            @foreach ($divisi as $d)
                                <option value="{{ $d->ID_DIVISI }}" @selected(old('ID_DIVISI') == $d->ID_DIVISI)>
                                    {{ $d->NAMA_DIVISI }} ({{ $d->ID_DIVISI }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">NIP</label>
                        <input type="text" name="NIP" value="{{ old('NIP') }}" class="form-control" required>
                    </div>

                    <div class="col-md-8">
                        <label class="form-label">Nama Pegawai</label>
                        <input type="text" name="NAMA_PEGAWAI" value="{{ old('NAMA_PEGAWAI') }}" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Jabatan</label>
                        <input type="text" name="JABATAN" value="{{ old('JABATAN') }}" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email Kantor</label>
                        <input type="text" name="EMAIL_KANTOR" value="{{ old('EMAIL_KANTOR') }}" class="form-control">
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('pegawai.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
