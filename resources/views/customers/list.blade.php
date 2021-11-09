@extends('layouts.basic')
@section('page-title', 'Eastnetic')
@section('content')

  <div class="content-wrapper" style="min-height: 976.12px;margin-left: 0px;">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Simple Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/"></a></li>
              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <form method="get" enctype="multipart/form-data" accept-charset="utf-8" role="form" novalidate="novalidate" autocomplete="off" class="form-table1 form-horizontal" action="{{ $CURRENT_URL }}">
                  
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Top Secret CIA Database</h3>
                </div>

                <!-- form start -->
                <div class="card-body row">
                    
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-12 col-form-label">Year</label>
                    <div class="col-sm-12">
                      <select class="form-control" name="birth_year">
                        <option value="">Year</option>
                        @foreach($birth_years as $year)
                        <option value="{{ $year }}" {{ (old('birth_year') ? old('birth_year') : $data['birth_year'] ?? '') == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                      </select>

                      
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-12 col-form-label">Month</label>
                    <div class="col-sm-12">
                      <select class="form-control" name="birth_month">
                          <option value="">Month</option>
                          @foreach($birth_months as $month)
                            <option value="{{ $month }}" {{ (old('birth_month') ? old('birth_month') : $data['birth_month'] ?? '') == $month ? 'selected' : '' }}>{{ $month }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-12 col-form-label"></label>
                    <div class="pt-1 mt-2 col-sm-12">
                      <button type="submit" class="btn bg-gradient-warning">Filter</button>
                    </div>
                  </div>
                </div>
                  <!-- /.card-body -->
                
                <!-- /.card-header -->
                <div class="card-body">
                  <?php
                  if (!isset($data['birth_year'])) {
                    ?>
                    <div class="row">
                      <div class="col-sm-12 col-md-12">
                        <?php
                        }
                        ?>
                        <?php
                        if (!isset($data['birth_year'])) {
                          ?>
                        <table class="table table-bordered">
                          <?php
                        } else {
                          ?>
                        <table id="example1" class="table table-bordered table-striped">
                          <?php
                        }
                        ?>
                            <thead>                  
                              <tr>
                                <th style="width: 350px">Email</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th style="width: 150px">Phone</th>
                                <th>Location</th>
                                <th style="width: 150px">Birthday</th>
                              </tr>
                            </thead>
                            <tbody>

                              <?php
                              $counter = 1;
                              foreach($allcustomers as $row){
                                ?>

                                
                                      <tr>
                                        <td>
                                          <div class="float-left custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                                            <label for="customCheckbox1" class="custom-control-label"></label>
                                          </div>
                                          {{$row->email}}
                                        </td>
                                        <td>{{$row->id}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->phone}}</td>
                                        <td>{{$row->country}}</td>
                                        <td>{{ date('Y-m-d', strtotime($row->birthday)) }}</td>
                                      </tr>
                                    
                                    
                                <!-- /.card-body -->
                              <?php
                              }
                              ?>
                            </tbody>
                        </table>
                        <?php
                        if (!isset($data['birth_year'])) {
                          ?>
                      </div>
                    </div>
                  <?php
                  }
                  ?>
                  <?php
                  if (!isset($data['birth_year'])) {
                    ?>
                    {{ $allcustomers->withQueryString()->links('partials.pagination', ['totalTalent' => $totalCustomer]) }}

                    <?php
                  }
                  ?>
                </div>
                
              </div>
              <!-- /.card -->
              
              <div class="card col-md-6">
                <div class="card-header">
                  <h3 class="card-title">How Many People?</h3>
                </div>
                <!-- form start -->
                
                  <div class="card-body row">
                    <p> Enter a number how many people you want to add to the list
                      <div class="form-group col-md-12">
                      <div class="col-sm-12">
                          <input type="text" class="form-control" name="paginate" value="{{ isset($data['paginate']) ? $data['paginate'] : $paginate }}" placeholder="20" >
                        </div>
                      </div>
                      
                      <div class="form-group col-md-12">
                        <div class="float-right">
                          <button class="btn btn-default">Cancel</button>
                          <button type="submit" class="btn bg-gradient-warning">Start</button>
                        </div>
                      </div>
                  </div>
                  <!-- /.card-body -->
                
              </div>
            </form>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
        "searching": false,
        "lengthChange": false,
        "pageLength":<?php echo $paginate; ?>
      });
    });
  </script>
@endsection