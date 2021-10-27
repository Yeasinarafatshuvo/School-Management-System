@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                           <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                             <div class="row">
                               <div class="col-12">
                                <div class="row"> {{--start row --}}
                                    <div class="col-md-6">{{--start col md-6 --}}
                                        <div class="form-group">
                                            <h5>User Name <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="name" value="{{ $editUserData->name }}" class="form-control">
                                            </div>
                                        </div>
                                     </div> {{--End col md-6 --}}
                                    <div class="col-md-6">{{--start col md-6 --}}
                                        <div class="form-group">
                                            <h5>User Email <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="email" value="{{ $editUserData->email }}" class="form-control">
                                            </div>
                                        </div>
                                     </div>{{--End col md-6 --}}
                                </div>{{--End row --}} 
                                <div class="row"> {{--start row --}}
                                    <div class="col-md-6">{{--start col md-6 --}}
                                        <div class="form-group">
                                            <h5>User Mobile <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="mobile" value="{{ $editUserData->mobile }}" class="form-control">
                                            </div>
                                        </div>
                                     </div> {{--End col md-6 --}}
                                    <div class="col-md-6">{{--start col md-6 --}}
                                        <div class="form-group">
                                            <h5>User Address <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="address" value="{{ $editUserData->address }}" class="form-control">
                                            </div>
                                        </div>
                                     </div>{{--End col md-6 --}}
                                </div>{{--End row --}}          
                                   <div class="row"> {{--start row --}}
                                       <div class="col-md-6">{{--start col md-6 --}}
                                            <div class="form-group">
                                            <h5>User Gender <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="gender" id="gender" required="" class="form-control">
                                                        <option value="" selected="" disabled="">Select Role</option>
                                                        <option value="Male" {{ $editUserData->gender == "Male" ? "selected" : "" }}>Male</option>
                                                        <option value="Female" {{ $editUserData->gender == "Female" ? "selected" : "" }}>Female</option>
                                                    </select>
                                                </div>
                                            </div>	
                                        </div> {{--End col md-6 --}}
                                       <div class="col-md-6">{{--start col md-6 --}}
                                            <div class="form-group">
                                                <h5>Profile Image <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="image" class="form-control" id="image">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                               
                                                <div class="controls">
                                                   <img id="showImage" src="{{ !empty($editUserData->image) ?  url('upload/user_images/' .$editUserData->image):url('upload/no_image.jpg') }}" alt="" style="width: 100px; border: 1px solid #000000 ">
                                                </div>
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

    <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection