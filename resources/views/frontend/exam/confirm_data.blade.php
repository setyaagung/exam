@extends('layouts.frontend-main')

@section('title','Konfirmasi Data')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <b>PERATURAN UJIAN</b>
                </div>
                <div class="card-body">
                    <div class=" justify-content-center">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident magnam at, corrupti sunt amet in eius eveniet minus adipisci perspiciatis eum qui ipsa distinctio facere eos, soluta sint asperiores delectus labore, odit impedit! Fugit blanditiis, incidunt veniam, facilis fuga, vero dolor animi dolores tempore illum modi vel? Corrupti dignissimos cum eveniet distinctio, laudantium excepturi mollitia ab eos, adipisci natus magnam, quae vel tempore quos. Veniam quaerat placeat voluptas non debitis consequuntur perferendis architecto blanditiis exercitationem in at consequatur maxime labore sunt ut, sit repellat nulla explicabo laboriosam magni qui incidunt? Nobis dolore, error minus maxime commodi molestias aliquid adipisci et?</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-3">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <b>DATA ANDA</b>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>NAMA</th>
                                    <td>{{ Auth::user()->name}}</td>
                                </tr>
                                <tr>
                                    <th>KELAS</th>
                                    <td>{{ $student->group->name}}</td>
                                </tr>
                                <tr>
                                    <th>GURU / MATA PELAJARAN</th>
                                    <td>{{ $exam->user->name}} / {{ $exam->course->name}}</td>
                                </tr>
                                <tr>
                                    <th>UJIAN</th>
                                    <td>{{ $exam->title}}</td>
                                </tr>
                                <tr>
                                    <th>JUMLAH SOAL</th>
                                    <td>{{ $count_exam}} Soal</td>
                                </tr>
                                <tr>
                                    <th>WAKTU</th>
                                    <td>{{ $exam->duration}} Menit</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
