@extends('layouts.app', ['activePage'=>'','titlePage' => 'خريطة المخالطين'])

@section('content')
    <?php $status='';
    if ($patient->status == 'contact'){
        $status='مخالط';
    }
    elseif ($patient->status == 'healthy'){
        $status='متعافي';
    }
    elseif ($patient->status == 'injured'){
        $status='مصاب';
    }
    ?>
    <div class="content">
        <div class="container-fluid">
            <div>
                <div class="card card-nav-tabs">
                    <div class="card-header card-header-info">
                        بيانات الشخص
                    </div>
                    <div class="d-flex justify-content-between">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">الاسم: {{$patient->first_name.' '.$patient->father_name.' '.$patient->granddad_name.' '.$patient->last_name}}</li>
                            <li class="list-group-item">رقم البطاقة: {{$patient->id_number}}</li>
                            <li class="list-group-item">رقم المحمول: {{$patient->phone}}</li>
                            <li class="list-group-item">الجنس: {{$patient->gender == 'male'?'ذكر':'أنثى'}}</li>
                        </ul>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">الحالة: {{$status}}</li>
                            <li class="list-group-item">المدينة: {{$patient->city}}</li>
                            <li class="list-group-item">المنطقة: {{$patient->area}}</li>
                            <li class="list-group-item">تاريخ الشفاء: {{$patient->date_healing}}</li>
                        </ul>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">تاريخ الإصابة: {{$patient->date_injury}}</li>
                            <li class="list-group-item">عدد أيام الإصابة: {{\Carbon\Carbon::parse($patient->date_injury)->diffInDays(\Carbon\Carbon::parse(today()))}}</li>
                        </ul>
                    </div>
                </div>
                @if($patient->contact->count() > 0)
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header card-header-warning">
                                <h4 class="card-title">الأشخاص الذين اختلط بهم</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم الكامل</th>
                                        <th>رقم البطاقة الشخصية</th>
                                        <th>الحالة</th>
                                        <th>رقم المحمول(الهاتف)</th>
                                        <th>المدينة</th>
                                        <th>المنطقة</th>
                                        <th>مكان المخالطة</th>
                                        <th>وقت المخالطة</th>
                                        <th>طريقة التعرف</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                               @foreach($patient->contact as $contact_map)
                                               <tr>
                                                   <?php $pat=$contact_map->contact_with ?>
                                                   <td>{{$pat->id}}</td>
                                                       <td><a href="{{route('contact.map',$pat->id)}}">{{$pat->first_name.' '.$pat->father_name.' '. $pat->granddad_name. ' '. $pat->last_name}}</a></td>
                                                       <td><a href="{{route('contact.map',$pat->id)}}">{{$pat->id_number}}</a></td>
                                                       <td>
                                                       @if ($pat->status == 'contact')
                                                           مخالط

                                                       @elseif ($pat->status == 'healthy')
                                                           متعافي

                                                       @elseif ($pat->status == 'injured')
                                                           مصاب
                                                       @endif
                                                   </td>
                                                   <td>{{$pat->phone}}</td>
                                                   <td>{{$pat->city}}</td>
                                                   <td>{{$pat->area}}</td>
                                                   <td>{{$contact_map->place}}</td>
                                                   <td>{{$contact_map->date}}</td>
                                                   <td>{{$contact_map->recognition_method == 1?'إدخال يدوي':'ترشيح نظام'}}</td>
                                               </tr>
                                           @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($patient->contact_with->count() > 0)
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header card-header-warning">
                                <h4 class="card-title">الأشخاص الذين اختلطوا به</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم الكامل</th>
                                        <th>رقم البطاقة الشخصية</th>
                                        <th>الحالة</th>
                                        <th>رقم المحمول(الهاتف)</th>
                                        <th>المدينة</th>
                                        <th>المنطقة</th>
                                        <th>مكان المخالطة</th>
                                        <th>وقت المخالطة</th>
                                        <th>طريقة التعرف</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($patient->contact_with as $contact_map)
                                        <tr>
                                            <?php $pat=$contact_map->contact ?>
                                            <td>{{$pat->id}}</td>
                                            <td><a href="{{route('contact.map',$pat->id)}}">{{$pat->first_name.' '.$pat->father_name.' '. $pat->granddad_name. ' '. $pat->last_name}}</a></td>
                                            <td><a href="{{route('contact.map',$pat->id)}}">{{$pat->id_number}}</a></td>
                                            <td>
                                                @if ($pat->status == 'contact')
                                                    مخالط

                                                @elseif ($pat->status == 'healthy')
                                                    متعافي

                                                @elseif ($pat->status == 'injured')
                                                    مصاب
                                                @endif
                                            </td>
                                            <td>{{$pat->phone}}</td>
                                            <td>{{$pat->city}}</td>
                                            <td>{{$pat->area}}</td>
                                            <td>{{$contact_map->place}}</td>
                                            <td>{{$contact_map->date}}</td>
                                            <td>{{$contact_map->recognition_method == 1?'إدخال يدوي':'ترشيح نظام'}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
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

