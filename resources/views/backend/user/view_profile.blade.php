@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
    <div class="container-full">
     

      <!-- Main content -->
      <section class="content">
        <div class="row">
            
            <div class="col-12">
                <div class="box box-widget widget-user">
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-black"  center center;">
					  <h3 class="widget-user-username">User Name:{{ $loginUserIdData->name }}</h3>
                      <a href="{{ route('profile.edit') }}" class="btn btn-rounded btn-success mb-5" style="float: right" >Edit Profile</a>
					  <h6 class="widget-user-desc">User Type: {{ $loginUserIdData->usertype }}</h6>
					  <h6 class="widget-user-desc">User Email: {{ $loginUserIdData->email }}</h6>
                                           </div> 
					<div class="widget-user-image">
					  <img class="rounded-circle" 
                      src="{{(!empty($loginUserIdData->image))? url('upload/user_images/' .$loginUserIdData->image):url('upload/no_image.jpg')}}" alt="User Avatar">
					</div>
					<div class="box-footer">
					  <div class="row">
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Mobile No</h5>
							<span class="description-text">{{ $loginUserIdData->mobile  }}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">Address</h5>
							<span class="description-text">{{ $loginUserIdData->address  }}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Gender</h5>
							<span class="description-text">{{ $loginUserIdData->gender  }}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
					  </div>
					  <!-- /.row -->
					</div>
				  </div>
                   
                  
            </div>
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