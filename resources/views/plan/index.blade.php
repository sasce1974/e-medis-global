@extends('layouts.app')
@section('content')
    <div class="d-flex py-0">
        <div class="bg-secondary" style="width: 300px">Here are the controls
            <h5>{{$start_date}}</h5>
        </div>
        <div id="calendar" class="w-100">
        </div>
    </div>
    <h4>{{ $period }}</h4>
@endsection

@section('scripts')
    <script>
        let start_date = {!! $start_date !!};
        let dates = {!! $dates !!};
    </script>
    <script src="{{ asset('js/calendar.js') }}"></script>
@endsection
