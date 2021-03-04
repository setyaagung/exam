@extends('layouts.frontend-main')

@section('title','Konfirmasi Data')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <b>TATA TERTIB PELAKSANAAN UJIAN</b>
                </div>
                <div class="card-body">
                    <div class="justify-content-center">
                        <ol style="margin-left: -20px">
                            <li>Perangkat dipastikan koneksi dengan internet</li>
                            <li>Mengerjakan sesuai dengan waktu dalam jadwal</li>
                            <li>Siswa mengerjakan mandiri tanpa bantuan dalam bentuk apapun. Mohon bantuan orang tua dalam hal pengawasan.</li>
                            <li>Selama ujian berlangsung dilarang:
                                <ul>
                                    <li>Menanyakan jawaban soal kepada siapapun.</li>
                                    <li>Bekerja sama dengan peserta lain.</li>
                                    <li>Memberi/menerima bantuan dalam menjawab soal.</li>
                                    <li>Memperlihatkan pekerjaan sendiri kepada peserta lain atau melihat pekerjaan peserta lain dengan cara apapun.</li>
                                    <li>Menggantikan/digantikan orang lain.</li>
                                </ul>
                            </li>
                            <li>Meninggalkan halaman soal sebelum jawaban benar-benar jawaban sudah terkirim.</li>
                            <li>Apabila ada hal yang menyebabkan siswa tidak bisa mengerjakan PAS, mohon memberi kabar (WA pribadi) supaya guru kelas tidak menunggu dalam ketidakpastian.</li>
                            <li>Tidak ada PAS susulan terutama bagi siswa yg tidak mengerjakan tanpa keterangan.</li>
                            <li>Ingat kejujuran menunjukkan integritas Anda.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 mt-3">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <b>DATA ANDA</b>
                </div>
                <div class="card-body">
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
                            <td>{{ $exam->duration / 60}} Menit</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="text-center">
                        <p class="card-text">Silahkan tekan tombol "Mulai" untuk memulai mengerjakan ujian</p>
                        <a href="{{ route('join_exam',$exam->slug)}}" class="btn btn-primary"><i class="fas fa-edit"></i> Mulai</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
