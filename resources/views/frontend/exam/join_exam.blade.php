@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <h5>Waktu : 120 Menit</h5>
                        </div>
                        <div class="col-sm-4">
                            <h5 class="js-timeout">02:00:00</h5>
                        </div>
                        <div class="col-sm-4">
                            <h5>Status : Pending</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <form action="">
                        <div class="row">
                            @foreach ($questionExam as $key => $question)
                                <div class="col-sm-12">
                                    <label class="font-weight-bold">{!! $question->question !!}</label>
                                    @php
                                        $options = json_decode($question->option);
                                    @endphp
                                    <div class="form-group ml-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answer{{ $key+1}}" value="{{ $options->option1}}">
                                            <label class="form-check-label">{{ $options->option1}}</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answer{{ $key+1}}" value="{{ $options->option2}}">
                                            <label class="form-check-label">{{ $options->option2}}</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answer{{ $key+1}}" value="{{ $options->option3}}">
                                            <label class="form-check-label">{{ $options->option3}}</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answer{{ $key+1}}" value="{{ $options->option4}}">
                                            <label class="form-check-label">{{ $options->option4}}</label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-sm-12 mt-3">
                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript">
        var interval;
        function countdown(){
            clearInterval(interval){
                interval = setInterval(function(){
                    var timer = $('.js-timeout').html();
                    timer = timer.split(':');
                    var minutes = timer[0];
                    var seconds = timer[1];
                    seconds -= 1;
                    if(minutes < 0) return;
                    else if(seconds < 0 && minutes != 0){
                        minutes -= 1;
                        seconds = 59;
                    }
                    else if(seconds < 10 && length.seconds != 2) seconds = '0' + seconds;
                    $('.js-timeout').html(minutes + ':' + seconds);

                    if(minutes == 0 && seconds == 0){
                        clearInterval(interval);
                        alert('Waktu Sudah Habis');
                    }
                },1000);
            }
            $('.js-timeout').text("02:00");
            countdown();
        }
    </script>
@endpush
