@extends('layout.app')

@section('title', 'Tambah Tamu')

@section('content')
    <div class="mb-3">
        <h1 class="h4 mb-1">Tambah Tamu</h1>
        <div class="text-muted">Form input data tamu baru</div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('tamu.store') }}">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">NIK</label>
                        <input type="number" name="NIK_TAMU" value="{{ old('NIK_TAMU') }}" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">No HP</label>
                        <input type="text" name="NO_HP" value="{{ old('NO_HP') }}" class="form-control" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="NAMA_LENGKAP" value="{{ old('NAMA_LENGKAP') }}" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Asal Instansi</label>
                        <input type="text" name="ASAL_INSTANSI" value="{{ old('ASAL_INSTANSI') }}" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="JENIS_KELAMIN" class="form-select" required>
                            <option value="">-- pilih --</option>
                            <option value="Laki-laki" @selected(old('JENIS_KELAMIN') === 'Laki-laki')>Laki-laki</option>
                            <option value="Perempuan" @selected(old('JENIS_KELAMIN') === 'Perempuan')>Perempuan</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Alamat</label>
                        <textarea name="ALAMAT" class="form-control" rows="3">{{ old('ALAMAT') }}</textarea>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('tamu.index') }}" class="btn btn-outline-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
