@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => 'الرئيسية'])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                  <div class="card-header card-header-success card-header-icon">
                      <div class="card-icon">
                          <i class="material-icons">check</i>
                      </div>
                      <p class="card-category">المتعافين</p>
                      <h3 class="card-title">{{$healthy}}</h3>
                  </div>
                  <div class="card-footer">
                      <div class="stats">
                          <i class="material-icons"></i>
                      </div>
                  </div>
              </div>
          </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">warning</i>
              </div>
              <p class="card-category">العدد المخالطين</p>
              <h3 class="card-title">{{$contact}}
                <small></small>
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-danger"></i>
                <a href="#pablo"></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">close</i>
              </div>
              <p class="card-category">المصابين</p>
              <h3 class="card-title">{{$injured}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">analytics</i>
              </div>
              <p class="card-category">العدد الكلي</p>
              <h3 class="card-title">{{$contact+ $healthy+ $injured}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-success">
              <div class="ct-chart" id="dailySalesChart">
                  {{round(($healthy/($contact+ $healthy+ $injured))*100, 2)}}%
              </div>
            </div>
            <div class="card-body">
              <h4 class="card-title">نسبة المتعافين</h4>
              <p class="card-category">
                <span class="text-success">{{round(($healthy/($contact+ $healthy+ $injured))*100, 2)}}%</span>
              </p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-warning">
              <div class="ct-chart" id="websiteViewsChart">
                  {{round(($contact/($contact+ $healthy+ $injured))*100, 2)}}%
              </div>
            </div>
            <div class="card-body">
              <h4 class="card-title">نسبة المخالطين</h4>
              <p class="card-category">
                  <span class="text-success">{{round(($contact/($contact+ $healthy+ $injured))*100, 2)}}%</span>
              </p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-danger">
              <div class="ct-chart" id="completedTasksChart">
                  {{round(($injured/($contact+ $healthy+ $injured))*100, 2)}}%
              </div>
            </div>
            <div class="card-body">
              <h4 class="card-title">نسبة المصابين</h4>
              <p class="card-category">
                  <span class="text-success">{{round(($injured/($contact+ $healthy+ $injured))*100, 2)}}%</span>

              </p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons"></i>
              </div>
            </div>
          </div>
        </div>
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
