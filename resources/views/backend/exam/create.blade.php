@extends('layouts.main')

@section('title','Buat Ujian')

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
                                Buat Ujian
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('exam.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Mata Pelajaran</label>
                                    <select name="course_id" class="form-control" required>
                                        <option value="">-- Pilih Mata Pelajaran --</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id}}">{{ $course->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Kelas</label>
                                    <select name="group_id" class="form-control" required>
                                        <option value="">-- Pilih Kelas --</option>
                                        @foreach ($groups as $group)
                                            <option value="{{ $group->id}}">{{ $group->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('group_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Ujian</label>
                                    <input id="exam_date" type="date" class="form-control @error('exam_date') is-invalid @enderror" name="exam_date" required>
                                    @error('exam_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="float-right">
                                    <a href="{{ route('exam.index')}}" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
