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
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Selamat!</strong> {{$message}}.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if ($show_result == '')
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td colspan="4" style="text-align: center">Belum ada nilai</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @else
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
                                                <td>{{ \Carbon\Carbon::parse($exam->exam_date)->isoFormat('DD MMMM Y')}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <h5 class="text-center"><b>HASIL {{ $exam->title}}</b></h5>
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th>Jumlah Soal</th>
                                                <td>:</td>
                                                <td>{{ \DB::table('exam_questions')->where('exam_id',$exam->id)->count()}}</td>
                                            </tr>
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
                                @endif
                                <div class="float-right">
                                    <a href="{{ route('ujian')}}" class="btn btn-secondary">Kembali</a>
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
