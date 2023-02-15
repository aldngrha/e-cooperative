@extends("layouts.admin.admin")

@section("title")
    Dashboard Admin Koperasi
@endsection

@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        @if(session()->has("message"))
            <div class="alert alert-success">
                <p>{{  session()->get("message") }}</p>
            </div>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h1 class="h3 mb-2 text-primary font-weight-bold">Tabel Anggota</h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter text-nowrap" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Anggota</th>
                            <th>Name</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Nomor HP</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Waktu Daftar</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->member_number }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->place_of_birth }}</td>
                                    <td>{{ Carbon\Carbon::parse($user->birth_of_date)->isoFormat("D MMMM, YYYY") }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ Carbon\Carbon::parse($user->created_at)->isoFormat("dddd, D MMMM YYYY") }}</td>
                                    <td>
                                        <form action="{{ route('member.destroy', $user->id) }}" class="d-inline" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    Data kosong
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
