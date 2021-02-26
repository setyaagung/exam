@extends('layouts.main')

@section('title','Edit Data Guru')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header"></div>
    <!-- /.content-header -->
    <section class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">
                                Edit Data Guru
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('teacher.update',$teacher->id)}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $teacher->name }}" required autocomplete="name" autofocus disabled>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Kelas yang Diajar</label>
                                    <select name="group_id[]" multiple="multiple" class="form-control select2 @error('group_id') is-invalid @enderror" data-placeholder="-- Pilih Kelas --" style="width: 100%;">
                                        @foreach ($groups as $group)
                                            <option value="{{ $group->id}}" {{in_array($group->id, $teacherGroupIds ?: []) ? "selected": ""}}>{{ $group->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('group_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Mapel yang Diajar</label>
                                    <select name="course_id[]" multiple="multiple" class="form-control select2 @error('course_id') is-invalid @enderror" data-placeholder="-- Pilih Kelas --" style="width: 100%;">
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id}}" {{in_array($course->id, $teacherCourseIds ?: []) ? "selected": ""}}>{{ $course->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('group_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="float-right">
                                    <a href="{{ route('teacher.index')}}" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
