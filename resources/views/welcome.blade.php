@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => config('app.name')])

@push('style')
    <style>
        /*Small devices (landscape phones, 576px and up)*/
        @media (min-width: 576px) {

        }

        /*Medium devices (tablets, 768px and up)*/
        @media (min-width: 768px) {
            #form{
                width: 500px;
            }
            .formCenter{
                display: flex;
                justify-content: center;
                align-items: center;
            }
        }

        /*Large devices (desktops, 992px and up)*/
        @media (min-width: 992px) {
            #form{
                width: 400px;
            }
        }

        /*Extra large devices (large desktops, 1200px and up)*/
        @media (min-width: 1200px) {
            #form{
                width: 400px;
            }
        }
    </style>
@endpush
@section('content')
<script data-ad-client="ca-pub-4730131153108157" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<div class="container">
          <h1 class="text-white text-center">{{'خليك بأمان'}}</h1>
         <div class="row">
             <div class="col-lg-6 col-sm-12 col-md-12 formCenter">
                         <div class="col-12 col-sm-6">
                             <h3>لأصحاب الأماكن</h3>
                             <form id="form" class="form" method="POST" action="{{ route('genQr') }}">
                                 @csrf

                                 <div class="card card-hidden">
                                     <div class="card-header card-header-primary text-center">
                                         <h4 class="card-title"><strong>تسجيل بيانات المكان</strong></h4>
                                     </div>
                                     <div class="card-body">
                                         <p class="card-description text-center">تسجيل بيانات المكان</p>
                                         <div class="bmd-form-group mb-2">
                                             <div class="input-group">
                                                 <div class="input-group-prepend">
                                                 <span class="input-group-text">
                                                    <i class="material-icons">home_work</i>
                                                  </span>
                                                  </div>
                                                  <input type="text" name="place" class="form-control" placeholder="اسم المكان" value="{{ old('place') }}" required>
                                              </div>
                                              @if ($errors->has('place'))
                                                  <div id="email-error" class="error text-danger pl-3" for="place" style="display: block;">
                                                      <strong>{{ $errors->first('place') }}</strong>
                                                  </div>
                                              @endif
                                          </div>
                                          <div class="bmd-form-group mb-2 d-flex justify-content-start" >
                                              <i class="material-icons mr-4"></i>
                                              <select class="form-control " name="category" id="exampleFormControlSelect1">
                                                  <option disabled selected class="text-muted">تصنيف المكان</option>
                                                  <option value="حكومي">حكومي</option>
                                                  <option value="سياحي">سياحي</option>
                                                  <option value="تعليمي">تعليمي</option>
                                                  <option value="تجاري">تجاري</option>
                                                  <option value="ترفيهي">ترفيهي</option>
                                                  <option value="رياضي">رياضي</option>
                                                  <option value="مواصلات">مواصلات</option>
                                                   <option value="أخرى">أخرى</option>
                                              </select>
                                              @if ($errors->has('category'))
                                                  <div id="email-error" class="error text-danger pl-3" style="display: block;">
                                                      <strong>{{ $errors->first('category') }}</strong>
                                                  </div>
                                              @endif

                                      </div>
                                      <div class="bmd-form-group mb-2">
                                          <div class="input-group">
                                              <div class="input-group-prepend">
                                              <span class="input-group-text">
                                                <i class="material-icons">location_on</i>
                                              </span>
                                              </div>
                                              <input type="text" name="city" class="form-control mx-2" placeholder="المدينة" value="{{ old('city') }}" required>
                                              <input type="text" name="area" class="form-control mx-2" placeholder="الحي" value="{{ old('area') }}" required>
                                              <input type="text" name="street" class="form-control mx-2" placeholder="الشارع" value="{{ old('street') }}" required>
                                          </div>
                                          @if ($errors->has('city'))
                                              <div class="error text-danger pl-3" style="display: block;">
                                                  <strong>{{ $errors->first('city') }}</strong>
                                              </div>
                                          @endif
                                          @if ($errors->has('area'))
                                              <div class="error text-danger pl-3" style="display: block;">
                                                  <strong>{{ $errors->first('area') }}</strong>
                                              </div>
                                          @endif
                                          @if ($errors->has('street'))
                                              <div class="error text-danger pl-3" style="display: block;">
                                                  <strong>{{ $errors->first('street') }}</strong>
                                              </div>
                                          @endif
                                      </div>
                                  </div>
                                      <div class="card-body">
                                          <p class="card-description text-center">تسجيل بيانات صاحب المكان</p>
                                          <div class="bmd-form-group mb-2">
                                              <div class="input-group">
                                                  <div class="input-group-prepend">
                                                  <span class="input-group-text">
                                                    <i class="material-icons">perm_identity</i>
                                                  </span>
                                                  </div>
                                                  <input type="text" name="name" class="form-control" placeholder="أدخل الاسم الرباعي" value="{{ old('name') }}" required>
                                              </div>
                                              @if ($errors->has('name'))
                                                  <div class="error text-danger pl-3" style="display: block;">
                                                      <strong>{{ $errors->first('name') }}</strong>
                                                  </div>
                                              @endif
                                          </div>
                                      <div class="bmd-form-group mb-2">
                                          <div class="input-group">
                                              <div class="input-group-prepend">
                                              <span class="input-group-text">
                                                <i class="material-icons">contacts</i>
                                              </span>
                                              </div>
                                              <input type="text" name="id_number" class="form-control mx-2" placeholder="رقم الهوية" value="{{ old('id_number') }}" required>
                                              <input type="text" name="phone" class="form-control mx-2" placeholder="رقم التواصل" value="{{ old('phone') }}" required>
                                              @if ($errors->has('id_number'))
                                                  <div class="error text-danger pl-3" style="display: block;">
                                                      <strong>{{ $errors->first('id_number') }}</strong>
                                                  </div>
                                              @endif
                                              @if ($errors->has('phone'))
                                                  <div class="error text-danger pl-3" style="display: block;">
                                                      <strong>{{ $errors->first('phone') }}</strong>
                                                  </div>
                                              @endif
                                          </div>
                                      </div>
                                  </div>
                                      <div class="card-footer justify-content-center">
                                          <button type="submit" class="btn btn-primary btn-link btn-lg">إنشاء رمز QR</button>
                                      </div>
                                      <p class="text-warning px-5">ملاحظة اذا كنت تمتلك عدد كبير من الاماكن الرجاء التواصل معنا عبر  رقم جوال 0599511356</p>
                                  </div>
                              </form>
                             </div>
              </div>
              <div class="col-lg-6 col-sm-12 col-md-12  d-flex flex-column justify-content-center align-items-center">
                  <h3>للمستخدمين تنزيل التطبيق</h3>
                  <h4>حمل التطبيق الآن من خلال المتاجر الالكترونية أو من خلال باركود</h4>
                  <div class="text-center d-flex justify-content-start">
                      <a href="https://play.google.com/store/apps/details?id=com.facebook.katana&hl=ar" class="m-2" target="_blank" rel="noopener noreferrer" style="border:none;text-decoration:none"><img height="40px" src="https://www.niftybuttons.com/googleplay/googleplay-button8.png"></a>
                      <br>
                      <a href="https://apps.apple.com/us/app/facebook/id284882215" class="m-2" target="_blank" rel="noopener noreferrer" style="border:none;text-decoration:none"><img height="40px" src="https://www.niftybuttons.com/itunes/itunesbutton6.png"></a>
                  </div>
                  <div class="mt-3">
                      {!! \QrCode::size(250)
                        ->gradient(250, 0, 180, 100,50, 150, 'vertical')
                        ->generate('https://play.google.com/store/apps/details?id=com.facebook.orca&hl=ar');
                      !!}
                  </div>
              </div>
  </div>
</div>
<div class="copyright float-right">
     
      .made with <i class="material-icons">favorite</i> by
     <a style="color:aquamarine">Ahmad Said Abu Selmya</a>  for a better web

    </div>
@endsection
