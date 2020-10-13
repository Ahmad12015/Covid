@extends('layouts.app', ['activePage' => 'place table', 'titlePage' => 'جدول الأماكن و المحلات'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div id="app">
                <place-table-component></place-table-component>
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
