@extends('layouts.frontend-main')

@section('title','Hasil Ujian')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-primary card-outline">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <h5 class="text-center"><b>INFORMASI PESERTA UJIAN</b></h5>
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th>Nama</th>
                                            <td>:</td>
                                            <td>{{ Auth::user()->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Kelas</th>
                                            <td>:</td>
                                            <td>{{ $student->group->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>:</td>
                                            <td>{{ Auth::user()->email}}</td>
                                        </tr>
                                        <tr>
                                            <th>Ujian</th>
                                            <td>:</td>
                                            <td>{{ $exam->title}}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Ujian</th>
                                            <td>:</td>
                                            <td>{{ $exam->exam_date}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h5 class="text-center"><b>HASIL {{ $exam->title}}</b></h5>
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th>Jawaban Benar</th>
                                            <td>:</td>
                                            <td>{{ $show_result->true_answer}}</td>
                                        </tr>
                                        <tr>
                                            <th>Jawaban Salah</th>
                                            <td>:</td>
                                            <td>{{ $show_result->false_answer}}</td>
                                        </tr>
                                        <tr>
                                            <th>Nilai</th>
                                            <td>:</td>
                                            <td>{{ round($show_result->true_answer / ($show_result->true_answer+$show_result->false_answer) * 100)}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="float-right">
                                    <a href="{{ route('exam')}}" class="btn btn-secondary">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
