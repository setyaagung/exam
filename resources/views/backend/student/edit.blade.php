@extends('layouts.main')

@section('title','Edit Data Siswa')

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
                                Eidt Data Siswa
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('student.update',$student->id)}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nama</label>
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $student->name }}" required autocomplete="name" autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" group="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Kelas</label>
                                            <select name="group_id" class="form-control @error('group_id') is-invalid @enderror" required>
                                                <option value="">-- Pilih Kelas --</option>
                                                @foreach ($groups as $group)
                                                    <option value="{{ $group->id}}" {{ $student->group_id == $group->id ? 'selected':''}}>{{ $group->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('group_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="float-right">
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
