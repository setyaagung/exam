@extends('layouts.frontend-main')

@section('title')
    {{ $exam->title}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-8">
                            <table class="table table-borderless">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>{{ Auth::user()->name}}</td>
                                    <td>Ujian</td>
                                    <td>:</td>
                                    <td>{{$exam->title}}</td>
                                </tr>
                                <tr>
                                    <td>Kelas</td>
                                    <td>:</td>
                                    <td>{{ $exam->group->name}}</td>
                                    <td>Durasi</td>
                                    <td>:</td>
                                    <td>{{$exam->duration / 60}} Menit</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-4">
                            <h6 id="exam_timer" data-timer="{{ $exam->duration}}" style="max-width: 400px; width: 100%; height:100px"></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9 mt-3">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <b>{{ $exam->title}}</b>
                </div>
                <div class="card-body">
                    <div class="questions" id="question-div">
                        <form action="{{ route('submit_exam')}}" method="POST" id="question-form">
                            @csrf
                            <input type="hidden" name="exam_id" value="{{ $exam->id}}">
                            <div class="row">

                                @foreach ($questionExam as $key => $question)
                                    <div id="div-{{$key+1}}" class="col-sm-12 question {{ $key+1>1 ? 'hide':''}}">
                                        <label class="font-weight-bold">{!! $question->question !!}</label>
                                        @php
                                            $options = json_decode($question->option);
                                        @endphp
                                        <input type="hidden" id="question{{ $key+1}}" name="question{{ $key+1}}" value="{{ $question->id}}">
                                        <div class="form-group ml-3" style="margin-top: -15px">
                                            <div class="form-check">
                                                <label class="form-check-label" data-id="{{$key+1}}">
                                                    <input class="form-check-input" type="radio" name="answer{{ $key+1}}" value="{{ $options->option1}}">
                                                    {{ $options->option1}}
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label" data-id="{{$key+1}}">
                                                    <input class="form-check-input" type="radio" name="answer{{ $key+1}}" value="{{ $options->option2}}">
                                                    {{ $options->option2}}
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label" data-id="{{$key+1}}">
                                                    <input class="form-check-input" type="radio" name="answer{{ $key+1}}" value="{{ $options->option3}}">
                                                    {{ $options->option3}}
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label" data-id="{{$key+1}}">
                                                    <input class="form-check-input" type="radio" name="answer{{ $key+1}}" value="{{ $options->option4}}">
                                                    {{ $options->option4}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $result = App\Model\Result::where('exam_id', $exam->id)->where('user_id', Auth::user()->id)->get()->first();

                                    @endphp
                                @endforeach
                                <div class="col-sm-12 mt-3">
                                    <input type="hidden" name="index" value="{{ $key+1}}">
                                    <div class="float-left mb-2 btn btn-secondary button hide" id="prev" style="margin-top: -15px">Prev</div>
                                    <div class="float-right mb-2 btn btn-success button hide" id="next" style="margin-top: -15px">Next</div>
                                    <button id="submit" type="submit" class="btn btn-primary btn-block hide" onclick="return confirm('Yakin ingin submit ujian kamu ?')">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mt-3">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    @foreach ($questionExam as $key => $question)
                        <div class="btn-group mb-1">
                            <button type="button" class="btn btn-success question_navigation" value="{{ $question->id}}">{{ $key+1}}</button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <style>
        .hide{
            display: none;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            var maxq = {{ $maxQuestion}}
            $('.form-check-label').click(function(e){
                var id = parseInt($(this).data('id'));
                if(id == 1) {
                    $('.button').addClass('hide');
                }
                if(id != maxq){
                    $('#next').removeClass('hide');
                }
                var next = (id+1);
			    var prev = (id-1);
			    $('#next').data('id',next);
			    $('#prev').data('id',prev);
            });

            $('#next').click(function(e) {
		    	var id = $(this).data('id');
		    	$('.button').addClass('hide');
		    	//$('#next').removeClass('hide');
		    	if(id == maxq) {
                    $('#submit,#prev').removeClass('hide');
                }
		    	else {
                    $('.button').addClass('hide');
                    $('#prev').removeClass('hide');
                }
		    	$('.question').addClass('hide');
		    	$('#div-'+id).removeClass('hide');
		    	var next = id+1;
		    	var prev = id-1;
		    	$('#next').data('id',next);
		    	$('#prev').data('id',prev);
		    });

            $('#prev').click(function(e) {
		    	var id = $(this).data('id');
		    	$('#prev').removeClass('hide');
		    	if(id==1){
                    $('.button').addClass('hide');
		    	    $('.question').addClass('hide');
		    	    $('#div-'+id).removeClass('hide');
                }
		    	var next = id+1;
		    	var prev = id-1;
		    	$('#next').data('id',next);
		    	$('#prev').data('id',prev);
		    });

            $('#exam_timer').TimeCircles({
                time: {
                    Days: {
                        show:false
                    },
                }
            });

            interval = setInterval(function(){
                var remaining_seconds = $('#exam_timer').TimeCircles().getTime();
                if(remaining_seconds <= 0){
                    clearInterval(interval);
                    submit();
                    alert('Waktu ujian telah habis');
                    window.location.href = '{{ route('show_result',$exam->slug)}}';
                }
            },1000);

            function submit(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var form = $('#question-form');
                $.ajax({
                    type: "POST",
                    url: "/ujian/join/submit_exam",
                    //dataType:"json",
                    data: form.serialize(),
                    success: function (response) {
                        console.log(response);
                        if (response.status) {
                            window.location.href = '{{ route('show_result',$exam->slug)}}';
                        }
                    }
                });
            }
        });
    </script>
@endpush
