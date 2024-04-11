@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    Biodata Diri
                </div>
                <div class="card-body">
                    <div class="form-group text-center">
                        @if (Auth()->user()->foto_profile)
                            <img src="{{ asset('storage/' . Auth()->user()->foto_profile) }}" class="img-fluid rounded-circle"
                                width="150">
                        @else
                            <img src="{{ asset('images/foto-profile.png') }}" class="img-fluid rounded-circle"
                                width="150">
                        @endif
                    </div>

                    <h5 class="text-center mt-5">{{ Auth()->user()->name ?? '-' }}</h5>
                    <p class="text-center mb-4">{{ Auth()->user()->level ?? '-' }}</p>

                    <div class="mb-3">
                        <label><strong>Nama Lengkap</strong></label><br>
                        <span class="text-muted"><i>{{ Auth()->user()->name ?? '-' }}</i></span>
                    </div>

                    <div class="mb-3">
                        <label><strong>Username</strong></label><br>
                        <span class="text-muted"><i>{{ Auth()->user()->username ?? '-' }}</i></span>
                    </div>

                    <div class="mb-3">
                        <label><strong>Status</strong></label><br>
                        <span class="text-muted"><i>{{ Auth()->user()->level ?? '-' }}</i></span>
                    </div>

                    <div class="mb-3">
                        <label><strong>Telp / WA</strong></label><br>
                        <span class="text-muted"><i>{{ Auth()->user()->telp ?? '-' }}</i></span>
                    </div>

                    @if (Auth()->user()->foto_profile)
                        <div class="mb-3">
                            <form action="{{ route('setting.deletegambar') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    <i class="ti ti-x"></i>
                                    Hapus Gambar
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Pengaturan Bioadata Diri
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">Ganti Username</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                                aria-selected="false">Ganti Password</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-disabled" type="button" role="tab"
                                aria-controls="pills-disabled" aria-selected="false">Ganti Gambar</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab" tabindex="0">

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @elseif(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('setting.updateprofile') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg">

                                        <div class="mb-3">
                                            <label>Nama Lengkap</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti ti-user"></i>
                                                </span>
                                                <input type="text" name="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    placeholder="Masukan Nama Lengkap"
                                                    value="{{ Auth()->user()->name ?? '-' }}">
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="mb-3">
                                            <label>No Telp / WA</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti ti-phone"></i>
                                                </span>
                                                <input type="text" name="telp"
                                                    class="form-control @error('telp') is-invalid @enderror"
                                                    placeholder="Masukan nomor telepon"
                                                    value="{{ Auth()->user()->telp ?? '-' }}">
                                                @error('telp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success">
                                        <i class="ti ti-device-floppy"></i>
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab" tabindex="0">
                            <form action="{{ route('setting.updateusername') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg">
                                        <div class="mb-3">
                                            <label>Username Lama</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti ti-user"></i>
                                                </span>
                                                <input type="text" name="usernamelama"
                                                    class="form-control @error('usernamelama') is-invalid @enderror"
                                                    placeholder="Masukan username lama"
                                                    value="{{ Auth()->user()->username ?? '-' }}" readonly>
                                                @error('usernamelama')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="mb-3">
                                            <label>Username Baru</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti ti-user"></i>
                                                </span>
                                                <input type="text" name="username"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    placeholder="Masukan username baru">
                                                @error('username')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success">
                                        <i class="ti ti-device-floppy"></i>
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                            aria-labelledby="pills-contact-tab" tabindex="0">
                            <form action="{{ route('setting.updatepassword') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg">
                                        <div class="mb-3">
                                            <label>Password</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti ti-lock"></i>
                                                </span>
                                                <input type="password" name="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    placeholder="Masukan password">
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label>Konfirmasi Password</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti ti-lock"></i>
                                                </span>
                                                <input type="password" name="konfirmasipassword"
                                                    class="form-control @error('konfirmasipassword') is-invalid @enderror"
                                                    placeholder="Masukan konfirmasi password">
                                                @error('konfirmasipassword')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-success">
                                                <i class="ti ti-device-floppy"></i>
                                                Simpan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="pills-disabled" role="tabpanel"
                            aria-labelledby="pills-disabled-tab" tabindex="0">
                            <form action="{{ route('setting.updategambar') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label>Foto Profile</label>
                                    <input type="file" name="foto_profile"
                                        class="form-control @error('foto_profile') is-invalid @enderror">
                                    @error('foto_profile')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success">
                                        <i class="ti ti-device-floppy"></i>
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
