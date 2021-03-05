@extends('layouts.frontend-main')

@section('title','Ujian')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title m-0">Ujian</h5>
                </div>

                <div class="card-body">

                    <table id="example1" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>UJIAN</th>
                                <th>MATA PELAJARAN</th>
                                <th>DIBUAT</th>
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
                                    <td>{{ $exam->user->name}}</td>
                                    <td>{{ \Carbon\Carbon::parse($exam->exam_date)->isoFormat('DD MMMM Y')}}</td>
                                    <td>
                                        @if (strtotime($exam->exam_date) < strtotime(date('Y-m-d')))
                                            <span class="badge badge-success">Selesai</span>
                                        @elseif(strtotime($exam->exam_date) == strtotime(date('Y-m-d')))
                                            <span class="badge badge-info">Sedang Berjalan</span>
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                        @endif
                                    </td>
                                    @php
                                        $result = App\Model\Result::where('exam_id', $exam->id)->where('user_id', Auth::user()->id)->get()->first();

                                    @endphp
                                    <td>
                                        @if(strtotime($exam->exam_date) == strtotime(date('Y-m-d')))
                                            @if (!$result)
                                                <a href="{{ route('confirm_data',$exam->slug)}}" class="btn btn-primary btn-sm">Mulai Ujian</a>
                                            @else
                                                <a href="{{ route('show_result',$exam->slug)}}" class="btn btn-success btn-sm">Lihat Nilai</a>
                                            @endif
                                        @elseif(strtotime($exam->exam_date) < strtotime(date('Y-m-d')))
                                            @if ($result)
                                            <a href="{{ route('show_result',[$exam->slug,$result->id])}}" class="btn btn-success btn-sm">Lihat Nilai</a>
                                            @endif
                                        @endif
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
@endsection
