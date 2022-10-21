@extends("layouts.app")

@section("title")
    Koperasi - Profile Anggota
@endsection

@section("content")
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @elseif(session()->has("message"))
            <div class="alert alert-success">
                <p>{{  session()->get("message") }}</p>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-header">
                <h3 class="card-title text-primary font-weight-bold">Profil Anggota</h3>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="card-body">
                <form action="{{ route("update") }}" method="POST">
                    @method("put")
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="name">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old("name", Auth::user()->name) }}">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="email">Email</label>
                                    <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old("email", Auth::user()->email) }}">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Tempat Lahir</label>
                                    <input type="text" name="place_of_birth" class="form-control{{ $errors->has('place_of_birth') ? ' is-invalid' : '' }}" value="{{ old('place_of_birth', Auth::user()->place_of_birth) }}">
                                    @if ($errors->has('place_of_birth'))
                                        <span class="invalid-feedback">{{ $errors->first('place_of_birth') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="date_of_birth" id="datepicker" autocomplete="off" class="form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" value="{{ old('date_of_birth', Auth::user()->date_of_birth) }}">
                                    @if ($errors->has('date_of_birth'))
                                        <span class="invalid-feedback">{{ $errors->first('date_of_birth') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">No Telepon</label>
                                    <input type="text" name="phone_number" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" value="{{ old('phone_number', Auth::user()->phone_number) }}">
                                    @if ($errors->has('phone_number'))
                                        <span class="invalid-feedback">{{ $errors->first('phone_number') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Jabatan</label>
                                    <input type="text" name="position" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" value="{{ old('position', Auth::user()->position) }}">
                                    @if ($errors->has('position'))
                                        <span class="invalid-feedback">{{ $errors->first('position') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <div class="custom-controls-stacked">
                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="M"{!! old('gender', Auth::user()->gender) == 'M' ? ' checked=""' : '' !!}>
                                            <span class="custom-control-label">Laki-laki</span>
                                        </label>
                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="F"{!! old('gender', Auth::user()->gender) == 'M' ? '' : ' checked=""' !!}>
                                            <span class="custom-control-label">Perempuan</span>
                                        </label>
                                    </div>
                                    @if ($errors->has('gender'))
                                        <span class="invalid-feedback">{{ $errors->first('gender') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Alamat</label>
                            <textarea rows="2" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address">{{ old('address', Auth::user()->address) }}</textarea>
                            @if ($errors->has('address'))
                                <span class="invalid-feedback">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
