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
                <h3 class="box-title">Teacher Designation</h3>
                <a href="{{ route('designation.add') }}" style="float: right" class="btn btn-md btn-rounded btn-success mb-5">Add Designation</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th width="5%">SL</th>           
                              <th>Designation Name</th>
                              <th width="25%">Action</th>
                             
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($designationData as $key => $designation)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $designation->name }}</td>                          
                                <td>
                                    <a href="{{ route('designation.edit', $designation->id) }}" class="btn btn-info">Edit</a>  
                                    <a href="{{ route('designation.delete', $designation->id ) }}" class="btn btn-primary" >Delete</a>
                                </td>
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