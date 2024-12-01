@extends('layouts.app')

@section('title', 'Admin')
@push('style')
    <!-- DataTables -->
    <link href="{{ asset('assets2/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush
@section('main')
    <div class="page-content">

        <!-- start page title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="page-title">
                            <h4>Jadwal</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Menu</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Jadwal</a></li>
                                <li class="breadcrumb-item active">List</li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-end d-none d-sm-block">
                            <a href="{{ route('jadwal.create') }}" class="btn btn-success"><i class="fas fa-plus"></i>
                                Add Data</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="container-fluid">

            <div class="page-content-wrapper">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-centered datatable dt-responsive nowrap "
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="thead-light">
                                            <tr>
                                                <th style="width: 20px;">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="ordercheck">
                                                        <label class="form-check-label" for="ordercheck">&nbsp;</label>
                                                    </div>
                                                </th>
                                                <th>No</th>
                                                <th>Tahun Ajaran</th>
                                                <th>Tanggal</th>
                                                <th>No Ruangan</th>
                                                <th>Ruangan</th>
                                                <th>Jumlah</th>
                                                <th>Sesi</th>
                                                <th>Jam</th>
                                                <th style="width: 120px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jadwal as $no => $item)
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="ordercheck1">
                                                            <label class="form-check-label" for="ordercheck1">&nbsp;</label>
                                                        </div>
                                                    </td>
                                                    <td class="text-dark fw-bold">{{ $no + 1 }}</td>
                                                    <td>{{ $item->tahun_ajaran->awal_tahun_ajaran }}/{{ $item->tahun_ajaran->akhir_tahun_ajaran }}</td>
                                                    <td>{{ $item->tanggal }}</td>
                                                    <td>Ruangan {{ $item->no_ruangan }}</td>
                                                    <td>{{ $item->ruangan}}</td>
                                                    <td>{{ $item->jumlah }}</td>
                                                    <td>{{ $item->sesi }}</td>
                                                    <td>{{ $item->jam }}</td>
                                                    <td id="tooltip-container1">
                                                        <a href="{{ route('jadwal.edit', $item->id) }}"
                                                            class="me-3 text-primary"
                                                            data-bs-container="#tooltip-container1" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Edit"><i
                                                                class="mdi mdi-pencil font-size-18"></i></a>
                                                        <form action="{{ route('jadwal.destroy', $item->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="javascript:void(0);" class="text-danger delete-jurusan"
                                                                data-bs-container="#tooltip-container1"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Delete">
                                                                <i class="mdi mdi-trash-can font-size-18"></i>
                                                            </a>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div>


        </div> <!-- container-fluid -->
    </div>
@endsection
@push('scripts')
    <!-- Required datatable js -->
    <script src="{{ asset('assets2/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('assets2/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('assets2/js/pages/ecommerce-datatables.init.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteLinks = document.querySelectorAll('.delete-jurusan');

            deleteLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();

                    if (confirm('Are you sure you want to delete this jadwal?')) {
                        this.closest('form').submit();
                    }
                });
            });
        });
    </script>
@endpush