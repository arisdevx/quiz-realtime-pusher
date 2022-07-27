@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ut tempor elit. Vestibulum sagittis neque pharetra porttitor cursus. Integer non sem et sapien tristique aliquet id nec nisl.</p>
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="answer-1" name="answer" class="custom-control-input" value="A">
                            <label class="custom-control-label" for="answer-1">A</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="answer-2" name="answer" class="custom-control-input" value="B">
                            <label class="custom-control-label" for="answer-2">B</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="answer-3" name="answer" class="custom-control-input" value="C">
                            <label class="custom-control-label" for="answer-3">C</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="answer-4" name="answer" class="custom-control-input" value="D">
                            <label class="custom-control-label" for="answer-4">D</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">{{ __('Result') }}</div>
                <div class="card-body" id="result">
                    <span class="text-muted empty-result">{{ __('No data available') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
<script>
    let answers = document.querySelectorAll('input[type="radio"][name="answer"]');
    let result = document.getElementById('result');

    answers.forEach(answer => {
        answer.addEventListener('change', (e) => {
            axios.post('{{ route('answer') }}', {
                answer: e.target.value
            });
        });
    });

    window.onload = () => {
        console.log('run');
        Echo.private('quiz.question').listen('.QuizEvent', (e) => {
            console.log(e);
            let getEmptyResult = result.querySelector('.empty-result');
            let resultContent = '';

            if (getEmptyResult) {
                result.innerHTML = '<p>'+ e.user.name + ': ' + e.answer + '</p>';
            } else {
                resultContent = result.innerHTML;
                resultContent += '<p>'+ e.user.name + ': ' + e.answer + '</p>';
                result.innerHTML = resultContent;
            }
        });

        setInterval(() => {
            // console.log('interval run');
            // if (Echo.connector.socket.connected) {
            //     console.log('connected');
            // } else {
            //     console.log('disconnected');
            // }
        }, 1000);

        // Echo.connector.socket.on('connect', () => {
        //     console.log('internet connected');
        // });

        // Echo.connector.socket.on('disconnect', () => {
        //     console.log('internet disconnected');
        // });
    }
</script>
@endpush
@endsection
