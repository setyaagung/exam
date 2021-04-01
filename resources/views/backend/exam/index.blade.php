@extends('layouts.main')

@section('title','Data Ujian')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">

    </div>
    <!-- /.content-header -->
    <section class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">
                                Data Ujian
                            </h3>
                            <a href="{{ route('exam.create')}}" class="btn btn-primary btn-sm float-right">Tambah</a>
                        </div>
                        <div class="card-body">
                            @if ($message = Session::get('create'))
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong> {{$message}}.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if ($message = Session::get('update'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Updated!</strong> {{$message}}.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if ($message = Session::get('delete'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Deleted!</strong> {{$message}}.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <table id="example1" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>TITLE</th>
                                        <th>MATA PELAJARAN</th>
                                        <th>KELAS</th>
                                        <th>TANGGAL UJIAN</th>
                                        <th>STATUS</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($exams as $exam)
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{ $exam->title}}</td>
                                            <td>{{ $exam->course->name}}</td>
                                            <td>{{ $exam->group->name}}</td>
                                            <td>{{ \Carbon\Carbon::parse($exam->exam_date)->isoFormat('DD MMMM Y')}}</td>
                                            <td>
                                                @if ($exam->status == 1)
                                                    <input type="checkbox" class="status" name="status" data-id="{{ $exam->id}}" checked>
                                                @else
                                                    <input type="checkbox" class="status" name="status" data-id="{{ $exam->id}}">
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('question',$exam->slug)}}" class="btn btn-sm btn-primary"><i class="fas fa-book"></i> Lihat Soal</a>
                                                <a href="{{ route('exam.show',$exam->id)}}" class="btn btn-sm btn-success"><i class="fas fa-file-alt"></i> Hasil Ujian</a>
                                                <a href="{{ route('exam.edit',$exam->id)}}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                                <form action="{{ route('exam.destroy', $exam->id)}}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini??')"><i class="fas fa-trash"></i> Hapus</button>
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
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.status').click(function (e) {
                e.preventDefault();
                var id = $(this).attr('data-id');

                $.ajax({
                    url: '/update-status/'+id,
                    type: 'GET',
                    success: function (response) {
                        alert('Status Ujian Berhasil Diperbarui') ? "": location.reload();
                        //alertify.set('notifier', 'position', 'top-right');
                        //alertify.success(response.status);
                    }
                });

            });
        });
    </script>
@endpush
