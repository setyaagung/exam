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
                                Hasil {{ $exam->title}}
                            </h3>
                            <a href="#" class="btn btn-danger btn-sm float-right"><i class="fas fa-file-pdf"></i> Cetak PDF</a>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NAMA</th>
                                        <th>JAWABAN BENAR</th>
                                        <th>JAWABAN SALAH</th>
                                        <th>NILAI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results as $result)
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{ $result->user->name}}</td>
                                            <td>{{ $result->true_answer}}</td>
                                            <td>{{ $result->false_answer}}</td>
                                            <td>{{ round($result->true_answer / ($result->true_answer + $result->false_answer) *100)}}</td>
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
