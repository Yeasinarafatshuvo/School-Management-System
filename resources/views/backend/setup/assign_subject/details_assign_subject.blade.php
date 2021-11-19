@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
    <div class="container-full">
     

      <!-- Main content -->
      <section class="content">
        <div class="row">
            
          <div class="col-12">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Assign Subject Details</h3>
                <a href="{{ route('assign.subject.add') }}" style="float: right" class="btn btn-md btn-rounded btn-success mb-5">Add Assign Subject</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                    <h4><strong>Assign Subject: </strong>{{ $detailsData[0]['student_class']['name'] }}</h4>
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th width="5%">SL</th>           
                              <th width="20%">Subject</th>
                              <th width="20%">Full Mark</th>
                              <th width="20%">Pass Mark</th>
                              <th width="20%">Subjective Mark</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($detailsData as $key => $details)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $details['school_subject']['name'] }}</td>
                                <td>{{ $details->full_mark }}</td>
                                <td>{{ $details->pass_mark }}</td>
                                <td>{{ $details->subjective_mark }}</td>                    
                                
                            </tr>
                          @endforeach
                         
                      </tbody>
                      <tfoot>
                        
                      </tfoot>
                    </table>
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