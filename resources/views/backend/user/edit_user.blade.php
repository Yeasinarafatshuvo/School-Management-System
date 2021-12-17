@extends('admin.admin_master')
@section('admin')
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <!-- Basic Forms -->
                 <div class="box">
                   <div class="box-header with-border">
                     <h4 class="box-title">Update User</h4>
                   </div>
                   <!-- /.box-header -->
                   <div class="box-body">
                     <div class="row">
                       <div class="col">
                           <form action="{{ route('users.update', $editUserData->id) }}" method="POST">
                            @csrf
                             <div class="row">
                               <div class="col-12">
                                   <div class="row"> {{--start row --}}
                                       <div class="col-md-6">{{--start col md-6 --}}
                                            <div class="form-group">
                                            <h5>User Role <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="role" id="usertype" required="" class="form-control">
                                                        <option value="" selected="" disabled="">Select Role</option>
                                                        <option value="Admin" {{ $editUserData->role == "Admin" ? "selected" : "" }}>Admin</option>
                                                        <option value="User" {{ $editUserData->role == "Operator" ? "selected" : "" }}>Operator</option>
                                                    </select>
                                                </div>
                                            </div>	
                                        </div> {{--End col md-6 --}}
                                       <div class="col-md-6">{{--start col md-6 --}}
                                            <div class="form-group">
                                                <h5>User Name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="name" value="{{ $editUserData->name }}" class="form-control" required="">
                                                </div>
                                            </div>
                                        </div>{{--End col md-6 --}}
                                   </div>{{--End row --}}
                                   <div class="row"> {{--start row --}}
                                    <div class="col-md-6">{{--start col md-6 --}}
                                        <div class="form-group">
                                            <h5>User Email <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="email" value="{{ $editUserData->email }}" class="form-control">
                                            </div>
                                        </div>
                                     </div> {{--End col md-6 --}}
                                    <div class="col-md-6">{{--start col md-6 --}}
                                         {{-- <div class="form-group">
                                             <h5>User Password <span class="text-danger">*</span></h5>
                                             <div class="controls">
                                                 <input type="password" name="password" class="form-control" required="">
                                             </div> --}}
                                         </div>
                                     </div>{{--End col md-6 --}}
                                </div>{{--End row --}}                                   	                         
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-info mb-5" value="Update">
                                </div>                                
                               </div>                            
                             </div>                                                  
                           </form>       
                       </div>
                       <!-- /.col -->
                     </div>
                     <!-- /.row -->
                   </div>
                   <!-- /.box-body -->
                 </div>
                 <!-- /.box -->
       
               </section> 
        </div>
    </div>
    <!-- /.content-wrapper -->

@endsection