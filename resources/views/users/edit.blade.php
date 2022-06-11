 @extends('layouts.main')
 @section('style')
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
 @endsection
 @section('content')
     <div class="col-12">
         @if (session()->has('success'))
             <div class="alert alert-success"
                 style="background-color: green;text-align: center;color: white;padding: 10px;margin:10px">
                 {{ session('success') }}
             </div>
         @endif



         @if (session()->has('delete'))
             <div class="alert alert-success"
                 style="background-color: red;text-align: center;color: white;padding: 10px;margin:10px">
                 {{ session('delete') }}
             </div>
         @endif
     </div>
     {{-- <div class="col-12">
         @csrf
         @method('put')
         <div class="form-group row">
             <label for="name" class="col-md-4 col-form-label">{{ __('messages.Name') }}</label>

             <div class="col-md-6">
                 <input id="name" type="text" class="form-control text-center @error('name') is-invalid @enderror"
                     name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                 @error('name')
                     <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                     </span>
                 @enderror
             </div>
         </div>

         <div class="form-group row">
             <label for="email" class="col-md-4 col-form-label ">{{ __('messages.Email') }}</label>

             <div class="col-md-6">
                 <input id="email" type="email" class="form-control text-center @error('email') is-invalid @enderror"
                     name="email" value="{{ $user->email }}" required autocomplete="email">

                 @error('email')
                     <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                     </span>
                 @enderror
             </div>
         </div>

         <div class="row" style="border: 1px solid white;margin: 60px">
             <div class="col-6" style="border: 1px solid white">


                 <h4 style="text-align:center;margin:10px">@lang('messages.roles')</h4>

                 <div class="panel-body">
                     <div class="task-content">
                         <div class="to-do-label">
                             <div class="checkbox-fade fade-in-primary">
                                 @foreach ($roles as $role)
                                     <label class="check-task">
                                         <input type="checkbox" name="roles[]"
                                             {{ $user->hasRole($role) ? 'checked' : '' }} value="{{ $role->id }}">
                                         <span class="cr">
                                             <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                         </span><span class="task-title-sp">
                                             {{ $role->name }}
                                     </label><br>
                                 @endforeach
                             </div>
                         </div>




                     </div>
                 </div>
             </div>




             <div class="col-6" style="border: 1px solid white">

                 <h4 style="text-align:center;margin:10px">@lang('messages.permissions')</h4>


                 <div class="panel-body">
                     <div class="task-content">
                         <div class="to-do-label">
                             <div class="checkbox-fade fade-in-primary">
                                 @foreach ($permissions as $permission)
                                     <label class="check-task">
                                         <input type="checkbox" name="permissions[]"
                                             {{ $user->hasPermissionTo($permission) ? 'checked' : '' }}
                                             value="{{ $permission->id }}">
                                         <span class="cr">
                                             <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                         </span><span class="task-title-sp">
                                             {{ $permission->name }}
                                     </label><br>
                                 @endforeach
                             </div>
                         </div>




                     </div>
                 </div>
             </div>
         </div>

         <div class="col-12" style="border: 1px solid white">

             <select name="company[]" class="js-example-basic-multiple" multiple="multiple">
                 @foreach ($companies as $company)
                     <option value="{{ $company->id }}">
                         {{ $company->name }}</option>
                 @endforeach
             </select>



             @foreach ($CompanyUser as $company)
                 {{ $company->companies->name }}
             @endforeach


         </div>



         <div class="col-12" style="border: 1px solid white">
             <select name="companyDetach[]" multiple id="">
                 @foreach ($companies as $company)
                     <option value="{{ $company->id }}">
                         {{ $company->name }}</option>
                 @endforeach
             </select>


             @foreach ($CompanyUser as $company)
                 {{ $company->companies->name }}
             @endforeach


         </div>

         <div style="text-align: center">

             <button type="submit" class="btn btn-success">@lang('messages.edit')</button>
         </div>


     </div> --}}





     <form action="{{ route('users.update', $user->id) }}" method="POST">
         @csrf
         @method('put')
         <div class="col-md-12 grid-margin stretch-card">
             <div class="card">
                 <div class="card-body">
                     <h4 class="card-title text-center">{{ $user->name }}</h4>
                     {{-- <p class="card-description">Horizontal bootstrap tab</p> --}}
                     <ul class="nav nav-tabs" role="tablist">
                         <li class="nav-item">
                             <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#mail" role="tab"
                                 aria-controls="home" aria-selected="true">@lang('messages.userNameAndMail')</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile-1" role="tab"
                                 aria-controls="profile" aria-selected="false">@lang('messages.rolesAndPermissions')</a>
                         </li>
                         {{-- <li class="nav-item">
                             <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact-1" role="tab"
                                 aria-controls="contact" aria-selected="false">Contact</a>
                         </li> --}}
                     </ul>
                     <div class="tab-content">
                         <div class="tab-pane fade show active" id="mail" role="tabpanel" aria-labelledby="home-tab">
                             <div class="media d-block d-sm-flex">
                                 {{-- <img class="me-3 w-25 rounded" src="../../../assets/images/samples/300x300/13.jpg"
                                 alt="sample image"> --}}

                                 <label for="name" class="col-md-4 col-form-label">{{ __('messages.Name') }}</label>

                                 <div class="col-md-6 mb-5">
                                     <input id="name" type="text"
                                         class="form-control text-center @error('name') is-invalid @enderror" name="name"
                                         value="{{ $user->name }}" required autocomplete="name" autofocus>

                                     @error('name')
                                         <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                         </span>
                                     @enderror
                                 </div>
                             </div>
                             <div class="media d-block d-sm-flex">
                                 {{-- <img class="me-3 w-25 rounded" src="../../../assets/images/samples/300x300/13.jpg"
                                 alt="sample image"> --}}

                                 <label for="email" class="col-md-4 col-form-label ">{{ __('messages.Email') }}</label>

                                 <div class="col-md-6">
                                     <input id="email" type="email"
                                         class="form-control text-center @error('email') is-invalid @enderror" name="email"
                                         value="{{ $user->email }}" required autocomplete="email">

                                     @error('email')
                                         <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                         </span>
                                     @enderror
                                 </div>
                             </div>
                         </div>
                         <div class="tab-pane fade" id="profile-1" role="tabpanel" aria-labelledby="profile-tab">
                             {{-- <img class="me-3 w-25 rounded" src="../../../assets/images/faces/face12.jpg"
                                 alt="sample image"> --}}
                             <div class="row" style="border: 1px solid white;margin: 60px">
                                 <div class="col-xl-6 col-sm-12" style="border: 1px solid white">


                                     <h4 style="text-align:center;margin:10px">@lang('messages.roles')</h4>

                                     <div class="panel-body">
                                         <div class="task-content">
                                             <div class="to-do-label">
                                                 <div class="checkbox-fade fade-in-primary">
                                                     @foreach ($roles as $role)
                                                         <label class="check-task">
                                                             <input type="checkbox" name="roles[]"
                                                                 {{ $user->hasRole($role) ? 'checked' : '' }}
                                                                 value="{{ $role->id }}">
                                                             <span class="cr">
                                                                 <i
                                                                     class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                             </span><span class="task-title-sp">
                                                                 {{ $role->name }}
                                                         </label><br>
                                                     @endforeach
                                                 </div>
                                             </div>




                                         </div>
                                     </div>
                                 </div>




                                 <div class="col-xl-6 col-sm-12" style="border: 1px solid white">

                                     <h4 style="text-align:center;margin:10px">@lang('messages.permissions')</h4>


                                     <div class="panel-body">
                                         <div class="task-content">
                                             <div class="to-do-label">
                                                 <div class="checkbox-fade fade-in-primary">
                                                     @foreach ($permissions as $permission)
                                                         <label class="check-task">
                                                             <input type="checkbox" name="permissions[]"
                                                                 {{ $user->hasPermissionTo($permission) ? 'checked' : '' }}
                                                                 value="{{ $permission->id }}">
                                                             <span class="cr">
                                                                 <i
                                                                     class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                             </span><span class="task-title-sp">
                                                                 {{ $permission->name }}
                                                         </label><br>
                                                     @endforeach
                                                 </div>
                                             </div>




                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         {{-- <div class="tab-pane fade" id="contact-1" role="tabpanel" aria-labelledby="contact-tab">
                             <div class="col-12">




                             </div>
                             <div class="row">
                                 <div class="col-3" style="margin: auto">


                                     <div class="form-group">
                                         <label>@lang('messages.addCompany')</label>
                                         <select class="js-example-basic-multiple" multiple="multiple" style="width:100%"
                                             name="company[]">
                                             @foreach ($companies as $company)
                                                 <option value="{{ $company->id }}">
                                                     {{ $company->name }}</option>
                                             @endforeach
                                         </select>
                                     </div>
                                 </div>
                                 <div class="col-6">
                                     <div class="table-responsive">
                                         <table id="order-listing2" class="table">
                                             <thead>
                                                 <tr>
                                                     <th>#</th>
                                                     <th>@lang('messages.Name')</th>
                                                     <th>@lang('messages.companyName')</th>
                                                     <th>action</th>

                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 @foreach ($CompanyUser as $key => $company)
                                                     <tr>
                                                         <td>{{ $key + 1 }}</td>
                                                         <td>{{ $company->users->name }}</td>
                                                         <td>{{ $company->companies->name }}</td>

                                                         <td>
                                                             <form method="post"
                                                                 action="{{ route('deletCompanyUser', $company->id) }}">
                                                                 @method('delete')
                                                                 @csrf
                                                                 <button class="badge badge-danger"
                                                                     onclick="return confirm('@lang('messages.sure')');">@lang('messages.delete')</button>
                                                             </form>
                                                         </td>

                                                     </tr>
                                                 @endforeach
                                             </tbody>
                                         </table>
                                     </div>
                                 </div>
                             </div>
                         </div> --}}
                     </div>
                 </div>
             </div>
         </div>
         <div style="text-align: center">

             <button type="submit" class="btn btn-success">@lang('messages.edit')</button>
         </div>
     </form>
 @endsection
 @section('script')
     <script>
         $(document).ready(function() {
             $('.js-example-basic-multiple').select2();
         });
     </script>

     <script>
         (function($) {
             'use strict';
             $(function() {
                 $('#order-listing2').DataTable({
                     "aLengthMenu": [
                         [2, 5, 10, 15, -1],
                         [2, 5, 10, 15, "All"]
                     ],
                     "iDisplayLength": 2,
                     "language": {
                         search: ""
                     }
                 });
                 $('#order-listing2').each(function() {
                     var datatable = $(this);
                     // SEARCH - Add the placeholder for Search and Turn this into in-line form control
                     var search_input = datatable.closest('.dataTables_wrapper').find(
                         'div[id$=_filter] input');
                     search_input.attr('placeholder', 'Search');
                     search_input.removeClass('form-control-sm');
                     // LENGTH - Inline-Form control
                     var length_sel = datatable.closest('.dataTables_wrapper').find(
                         'div[id$=_length] select');
                     length_sel.removeClass('form-control-sm');
                 });
             });
         })(jQuery);
     </script>

     <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 @endsection
