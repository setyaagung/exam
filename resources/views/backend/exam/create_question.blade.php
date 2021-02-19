@extends('layouts.main')

@section('title','Buat Pertanyaan')

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
                                Buat Pertanyaan {{ $exam->title}}
                            </h3>
                        </div>
                        <div class="card-body">
                            @if ($message = Session::get('create'))
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong> {{$message}}.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form action="{{ route('store_question')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="exam_id" value="{{ $exam->id}}">
                                <div class="form-group">
                                    <label for="">Pertanyaan</label>
                                    <textarea id="sumnote_question" class="form-control @error('question') is-invalid @enderror" name="question" required>{{ old('question')}}</textarea>
                                    @error('question')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Opsi A</label>
                                            <input type="text" class="form-control" name="option1" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Opsi B</label>
                                            <input type="text" class="form-control" name="option2" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Opsi C</label>
                                            <input type="text" class="form-control" name="option3" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Opsi D</label>
                                            <input type="text" class="form-control" name="option4" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Jawaban Benar</label>
                                    <input type="text" class="form-control" name="answer" required>
                                </div>
                                <div class="float-right">
                                    <a href="{{ route('question',$exam->slug)}}" class="btn btn-secondary">Kembali</a>
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

@push('scripts')
    <script type="text/javascript">
        $('#sumnote_question').summernote({
            tabsize: 2,
            height: 150
        });
    </script>
@endpush
