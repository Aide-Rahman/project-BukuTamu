@extends('layout.app')

@section('title', 'Edit Tamu')

@section('content')
    <div class="d-flex align-items-start justify-content-between mb-3">
        <div>
            <h1 class="h4 mb-1">Edit Tamu</h1>
            <div class="text-muted">{{ $tamu->NAMA_LENGKAP }} ({{ $tamu->ID_TAMU }})</div>
        </div>
        <a href="{{ route('tamu.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header fw-semibold">Data Tamu</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('tamu.update', $tamu) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">ID Tamu</label>
                            <input value="{{ $tamu->ID_TAMU }}" class="form-control" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NIK</label>
                            <input type="number" name="NIK_TAMU" value="{{ old('NIK_TAMU', $tamu->NIK_TAMU) }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="NAMA_LENGKAP" value="{{ old('NAMA_LENGKAP', $tamu->NAMA_LENGKAP) }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No HP</label>
                            <input type="text" name="NO_HP" value="{{ old('NO_HP', $tamu->NO_HP) }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Asal Instansi</label>
                            <input type="text" name="ASAL_INSTANSI" value="{{ old('ASAL_INSTANSI', $tamu->ASAL_INSTANSI) }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="ALAMAT" class="form-control" rows="3">{{ old('ALAMAT', $tamu->ALAMAT) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="JENIS_KELAMIN" class="form-select" required>
                                <option value="Laki-laki" @selected(old('JENIS_KELAMIN', $tamu->JENIS_KELAMIN) === 'Laki-laki')>Laki-laki</option>
                                <option value="Perempuan" @selected(old('JENIS_KELAMIN', $tamu->JENIS_KELAMIN) === 'Perempuan')>Perempuan</option>
                            </select>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header fw-semibold">Catat Kunjungan</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('tamu.kunjungan.store', $tamu) }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">ID Kunjungan</label>
                            <input type="text" name="ID_KUNJUNGAN" value="{{ old('ID_KUNJUNGAN') }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pegawai</label>
                            <select name="ID_PEGAWAI" class="form-select" required>
                                <option value="">-- pilih pegawai --</option>
                                @foreach ($pegawai as $p)
                                    <option value="{{ $p->ID_PEGAWAI }}" @selected(old('ID_PEGAWAI') == $p->ID_PEGAWAI)>
                                        {{ $p->NAMA_PEGAWAI }} ({{ $p->ID_PEGAWAI }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No Tiket</label>
                            <input type="text" name="NO_TIKET" value="{{ old('NO_TIKET') }}" class="form-control" required>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Waktu Checkin</label>
                                <input type="datetime-local" name="WAKTU_CHECKIN" value="{{ old('WAKTU_CHECKIN') }}" class="form-control">
                                <div class="form-text">Kosongkan untuk otomatis “sekarang”.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Waktu Chekout</label>
                                <input type="datetime-local" name="WAKTU_CHEKOUT" value="{{ old('WAKTU_CHEKOUT') }}" class="form-control">
                            </div>
                        </div>

                        <div class="mt-3">
                            <label class="form-label">Keperluan</label>
                            <textarea name="KEPERLUAN" class="form-control" rows="3" required>{{ old('KEPERLUAN') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success mt-3">Simpan Kunjungan</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header fw-semibold">Kunjungan Terakhir</div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No Tiket</th>
                                    <th>Pegawai</th>
                                    <th>Checkin</th>
                                    <th>Chekout</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tamu->kunjungan->take(5) as $k)
                                    <tr>
                                        <td>{{ $k->NO_TIKET }}</td>
                                        <td>{{ $k->pegawai?->NAMA_PEGAWAI }}</td>
                                        <td>{{ $k->WAKTU_CHECKIN }}</td>
                                        <td>{{ $k->WAKTU_CHEKOUT }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">Belum ada kunjungan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
