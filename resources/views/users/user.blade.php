@extends('layouts.app', ['activePage' => 'User table', 'titlePage' => 'جدول المشرفين'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div id="app">
                <user-table-component></user-table-component>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            md.initDashboardPageCharts();
        });
    </script>
@endpush
@push('js')
    <script src="{{asset('js/app.js')}}" defer></script>
@endpush
