<x-main>
    <x-slot name="header">
        <h2 class="ms-5 p-3">
            Pegawai
        </h2>
    </x-slot>
    <div class="row">
        <div class="col-4 mb-3">
            <a href="{{ route('employee.create') }}" class="btn btn-outline-success">Tambah Pegawai</a>
        </div>
        <div class="col-12">
            <table class="table-responsive table table-bordered border-dark">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th style="width: 5%;">#</th>
                        <th style="width: 20%;">Nama</th>
                        <th style="width: 20%;">Email</th>
                        <th style="width: 10%;">Status</th>
                        <th style="width: 35%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (empty($employees) || $employees->isEmpty())
                        <tr class="text-center">
                            <th colspan="5">Tidak ada data</th>
                        </tr>
                    @else
                        @foreach ($employees as $employee)
                            <tr class="text-center">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td class="text-start">{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>
                                    @if($employee->status == 1)
                                        <span class="badge bg-success"> Kasir Aktif</span>
                                    @elseif($employee->status == 0)
                                        <span class="badge bg-warning"> Kasir Tidak Aktif</span>
                                    @else
                                        <span class="badge bg-danger"> Ditangguhkan</span>
                                    @endif
                                </td>
                                <td class="d-flex justify-content-evenly">
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#changePassword{{$employee->id}}">
                                        Default Password
                                    </button>

                                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                                        data-bs-target="#suspend{{$employee->id}}">
                                        {{ $employee->status == -1 ? 'Aktifkan' : 'Menangguhkan' }}
                                    </button>

                                    <a href="{{ route('employee.update', ['id' => $employee->id]) }}"
                                        class="btn btn-outline-info">Edit</a>
                                    <form action="{{route('employee.delete', ['id' => $employee->id])}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="changePassword{{$employee->id}}" tabindex="-1"
                                aria-labelledby="changePassword{{$employee->id}}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="changePassword{{$employee->id}}Label">Rubah Password ke
                                                Default</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah anda yakin ingin merubah password pegawai ini ke default (passwordnya default
                                            adalah <span class="text-danger">12345678</span>)?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <a href="{{ route("employee.defaultpass", ['id' => $employee->id]) }}" class="btn btn-primary">Tetapkan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Suspend -->
                            <div class="modal fade" id="suspend{{$employee->id}}" tabindex="-1"
                                aria-labelledby="suspend{{$employee->id}}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="suspend{{$employee->id}}Label">
                                                {{$employee->status == -1 ? "Aktifkan akun?" : "Menangguhkan akun?"}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah anda yakin ingin {{$employee->status == -1 ? "Aktifkan" : "Menangguhkan"}} akun
                                            pegawai ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <a href="{{ route("employee.status", ['id' => $employee->id]) }}"
                                                class="btn btn-primary">{{$employee->status == -1 ? "Aktifkan" : "Menangguhkan"}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-main>