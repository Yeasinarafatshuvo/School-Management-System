@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
    <div class="container-full">
     

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
          <div class="box bl-3 border-primary">
            <div class="box-header">
            <h4 class="box-title">Student <strong>Search</strong></h4>
            </div>
            <div class="box-body">
           <form method="GET" action="{{ route('student.year.class.wise') }}">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                      <h5>Year </h5>
                      <div class="controls">   
                         <select name="year_id" id="year_id" required="" class="form-control">
                             <option value="" selected="" disabled="">Select Year</option>
                              @foreach ($years as $year)
                                  <option value="{{ $year->id }}"  {{ (@$years_id ==  $year->id ? "selected": "") }}>{{ $year->name }}</option>
                              @endforeach
                             
                         </select>
                           
                      </div>
                  </div> 
                 </div>

                 <div class="col-md-4">
                  <div class="form-group">
                      <h5>Class </h5>
                      <div class="controls">   
                         <select name="class_id" required="" class="form-control">
                             <option value="" selected="" disabled="">Select Class</option>
                             @foreach ($classes as $class)
                                  <option value="{{ $class->id }}" {{ (@$class_id ==  $class->id ? "selected": "") }}>{{ $class->name }}</option>
                              @endforeach
                         </select>
                           
                      </div>
                  </div> 
                 </div>

                 <div class="col-md-4" style="padding-top: 25px">
                   <input type="submit" class="btn btn-rounded btn-dark mb-5" name="search" id="" value="Search">
                 </div>
              </div>
           </form>
           
            </div>
          </div>
        </div>
            
          <div class="col-12">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Student  List</h3>
                <a href="{{ route('student.registration.add') }}" style="float: right" class="btn btn-md btn-rounded btn-success mb-5">Add Student</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    @if(!@search)                                    
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th width="5%">SL</th>           
                              <th>Name</th>
                              <th>ID No</th>
                              <th>Roll</th>
                              <th>Year</th>
                              <th>Class</th>
                              <th>Image</th>
                              @if (Auth::user()->role == 'Admin')
                              <th>Code</th>
                              @endif                                        
                              <th width="25%">Action</th>
                             
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($allStudentData as $key => $value)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $value['student']['name'] }}</td>
                                <td>{{ $value['student']['id_no'] }}</td>
                                <td>{{ $value->roll }}</td>
                                <td>{{ $value['student_year']['name'] }}</td>
                                <td>{{ $value['student_class']['name'] }}</td>
                               <td> <img  src="{{ !empty($value['student']['image']) ?  url('upload/student_images/' .$value['student']['image']):url('upload/no_image.jpg') }}" alt="" style="width: 60px; height:60px"></td>
                                <td>{{ $value->year_id }}</td>
                                
                                <td>
                                    <a href="" class="btn btn-info">Edit</a>
                                    <a href="" class="btn btn-danger" id="delete">Delete</a>
                                </td>
                            </tr>
                          @endforeach
                         
                      </tbody>
                      <tfoot>
                        
                      </tfoot>
                    </table>
                    @else
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th width="5%">SL</th>           
                              <th>Name</th>
                              <th>ID No</th>
                              <th>Roll</th>
                              <th>Year</th>
                              <th>Class</th>
                              <th>Image</th>
                              @if (Auth::user()->role == 'Admin')
                              <th>Code</th>
                              @endif                                        
                              <th width="25%">Action</th>
                             
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($allStudentData as $key => $value)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $value['student']['name'] }}</td>
                                <td>{{ $value['student']['id_no'] }}</td>
                                <td>{{ $value->roll }}</td>
                                <td>{{ $value['student_year']['name'] }}</td>
                                <td>{{ $value['student_class']['name'] }}</td>
                               <td> <img  src="{{ !empty($value['student']['image']) ?  url('upload/student_images/' .$value['student']['image']):url('upload/no_image.jpg') }}" alt="" style="width: 60px; height:60px"></td>
                                <td>{{ $value->year_id }}</td>
                                
                                <td>
                                    <a href="" class="btn btn-info">Edit</a>
                                    <a href="" class="btn btn-danger" id="delete">Delete</a>
                                </td>
                            </tr>
                          @endforeach
                         
                      </tbody>
                      <tfoot>
                        
                      </tfoot>
                    </table>
                    @endif
                  </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->

           
            <!-- /.box -->          
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>
</div>
<!-- /.content-wrapper -->

@endsection