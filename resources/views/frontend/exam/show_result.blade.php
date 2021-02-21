@extends('layouts.frontend-main')

@section('title','Hasil Ujian')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title m-0">Hasil $exam</h5>
                </div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Benar</td>
                            <td>:</td>
                            <td>{{ $exam->true_answer}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
