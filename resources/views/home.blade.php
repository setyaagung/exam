@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>UJIAN</th>
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
                                    <td>{{ \Carbon\Carbon::parse($exam->exam_date)->isoFormat('DD MMMM Y')}}</td>
                                    <td>
                                        @if (strtotime($exam->exam_date) < strtotime(date('Y-m-d')))
                                            <span class="badge badge-success">Selesai</span>
                                        @elseif(strtotime($exam->exam_date) == strtotime(date('Y-m-d')))
                                            <span class="badge badge-info">Running</span>
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('join_exam')}}" class="btn btn-primary btn-sm">Join Exam</a>
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
