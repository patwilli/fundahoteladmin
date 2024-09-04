 @extends('base')

 @section('main-content')
 <!-- Modal -->
 <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Edit Admin</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form action="{{route('updateAdmin')}}" method="POST">
                 @csrf
                 <div class="modal-body">

                     <input type="hidden" class="admin_id" name="admin_id">

                     <div class="mb-3">
                         <label for="">Name</label>
                         <input type="text" class="form-control admin_name" name="admin_name">
                     </div>
                     <div class="mb-3">
                         <label for="">Email</label>
                         <input type="text" class="form-control admin_email" name="admin_email">
                     </div>
                     <div class="mb-3">
                         <label for="">Phone number</label>
                         <input type="text" class="form-control admin_phone" name="admin_phone">
                     </div>

                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <button type="submit" name="update_admin_details" class="btn btn-primary">Update</button>
                 </div>
             </form>
         </div>
     </div>
 </div>


 <!-- Modal -->
 <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="addModal">Add Admin</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form action="{{route('addAdmin')}}" method="POST">
                 @csrf
                 <div class="modal-body">
                     <div class="mb-3">
                         <label for="">Name</label>
                         <input type="text" class="form-control" name="admin_name">
                     </div>
                     <div class="mb-3">
                         <label for="">Email</label>
                         <input type="text" class="form-control" name="admin_email">
                     </div>
                     <div class="mb-3">
                         <label for="">Phone number</label>
                         <input type="text" class="form-control" name="admin_phone">
                     </div>
                     <div class="mb-3">
                         <label for="">Password</label>
                         <input type="password" class="form-control" name="admin_password">
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <button type="submit" name="add_admin" class="btn btn-primary">Add Admin</button>
                 </div>
             </form>
         </div>
     </div>
 </div>

 <div class="main-content">
     <div class="section__content section__content--p30">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-10">
                     <div class="overview-wrap">
                         <h2 class="title-1">Manage Accounts</h2>
                     </div>
                 </div>
                 <div class="col-md-2">
                     <a href="#" data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-info float-end">Add Admin</a>
                 </div>
             </div>
             <br>
             <div class="row">
                 <div class="col-lg-12">
                     <div class="table-responsive table--no-card m-b-30">
                         <table class="table table-borderless table-striped table-earning">
                             <thead>
                                 <tr>
                                     <th class="text-center">Name</th>
                                     <th class="text-center">Email</th>
                                     <th class="text-center">Phone</th>
                                     <th class="text-center">Status</th>
                                     <th class="text-center">Action 1</th>
                                     <th class="text-center">Action 2</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @if(count($admins)>0)
                                 @foreach($admins as $admin)
                                 <tr>
                                     <td class="adname">{{$admin->name}}</td>
                                     <td class="ademail">{{$admin->email}}</td>
                                     <td class="adphone">{{$admin->phone}}</td>
                                     <td class="text-center">
                                         @if($admin->status==0)
                                         <span class="badge bg-success" style="color:white">Active</span>
                                         @else
                                         <span class="badge bg-danger" style=" color:white">Banned</span>
                                         @endif
                                     </td>
                                     <td class="text-center">
                                         @if($admin->status==0)
                                         <form action="{{route('updateBanAdmin')}}" method="post">
                                             @csrf
                                             <button type="submit" value="{{$admin->id}}" class="btn btn-danger btn-sm" name="ban_admin" {{ $admin->super_admin == 1 ? 'disabled' : '' }}>Ban</button>
                                             @else
                                             <form action="{route('updateUnbanAdmin')}}" method="post">
                                                 @csrf
                                                 <button type="submit" value="{{$admin->id}}" class="btn btn-success btn-sm" name="unban_admin">Unban</button>
                                                 @endif
                                             </form>
                                     </td>
                                     <td>
                                         <button type="button" class="btn btn-info edit_btn" name="edit_admin" value="{{$admin->id}}" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                                     </td>
                                 </tr>
                                 @endforeach
                                 @else
                                 <tr>
                                     <td colspan="8" class="text-center">
                                         <h4>Rien pour le moment</h4>
                                     </td>
                                 </tr>
                                 @endif
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 @endsection

 @section('footer-script')
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

 <script>
     $(document).ready(function() {
         $('.edit_btn').click(function(e) {
             e.preventDefault();

             var id = $(this).val();
             var name = $(this).closest('tr').find('.adname').text();
             var email = $(this).closest('tr').find('.ademail').text();
             var phone = $(this).closest('tr').find('.adphone').text();

             $('#editModal .admin_id').val(id);
             $('#editModal .admin_name').val(name);
             $('#editModal .admin_email').val(email);
             $('#editModal .admin_phone').val(phone);
             $('#editModal').modal('show');
         });
     });
 </script>

 @endsection