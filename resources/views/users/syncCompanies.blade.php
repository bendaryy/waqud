 @extends('layouts.main')

 @section('style')
     {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}

     <style>
         table,
         td,
         tr,
         th,
         #thead {
             border: 1px solid #aaa !important;
             color: white;
             opacity: 0.9;
         }

         td,
         th {
             padding: 20px !important;
         }

         th {
             font-size: 20px !important;
         }

         .dt-button,
         .buttons-copy,
         .buttons-html5 {
             background: black !important;
             color: white !important;
             margin: 10px
         }

         #basic-btn2_wrapper {
             margin: 20px
         }
         .select2-container--default .select2-selection--multiple .select2-selection__rendered{
            background-color: white;
         }

     </style>
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

     <form method="POST" action={{ route('AddsyncCompany', $user->id) }}>
         @csrf
         @method('post')

         <div class="col-12">
             <div class="row">
                 <div class="form-group">
                     <label>@lang('messages.addCompany')</label>
                     <select class="js-example-basic-multiple" multiple="multiple" style="width:100%" name="company[]">
                         @foreach ($companies as $company)
                             <option value="{{ $company->id }}">
                                 {{ $company->name }}</option>
                         @endforeach
                     </select>
                 </div>
             </div>
         </div>


         <div class="col-12">
             <div class="row">
                 <div class="col-3" style="margin: auto">


                     {{-- <div class="form-group">
                 <label>@lang('messages.addCompany')</label>
                 <select class="js-example-basic-multiple" multiple="multiple" style="width:100%" name="company[]">
                     @foreach ($companies as $company)
                         <option value="{{ $company->id }}">
                             {{ $company->name }}</option>
                     @endforeach
                 </select>
             </div> --}}
                 </div>
                 <div class="col-12 text-center">
                     <div class="table-responsive">
                         <table id="order-listing2" class="table">
                             <thead>
                                 <tr>
                                     <th id="thead">#</th>
                                     <th id="thead">@lang('messages.Name')</th>
                                     <th id="thead">@lang('messages.companyName')</th>


                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($CompanyUser as $key => $company)
                                     <tr>
                                         <td>{{ $key + 1 }}</td>
                                         <td>{{ $company->users->name }}</td>
                                         <td>{{ $company->companies->name }}</td>
                                     </tr>
                                 @endforeach
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>



         </div>
         <div style="margin: auto;text-align: center">

             <button type="submit" class="btn btn-success" style="padding:20px;font-weight: bold">@lang('messages.submit')</button>
         </div>
         </div>
     </form>

     {{-- @foreach ($CompanyUser as $company)
         <p style="color:white"> {{ $company->companies->name }}</p>
     @endforeach --}}
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
                     "iDisplayLength": 5,
                     "language": {
                         search: "@lang('messages.search') : "
                     }
                 });
                 $('#order-listing2').each(function() {
                     var datatable = $(this);
                     // SEARCH - Add the placeholder for Search and Turn this into in-line form control
                     var search_input = datatable.closest('.dataTables_wrapper').find(
                         'div[id$=_filter] input');
                     search_input.attr('placeholder', );
                     search_input.removeClass('form-control-sm');
                     // LENGTH - Inline-Form control
                     var length_sel = datatable.closest('.dataTables_wrapper').find(
                         'div[id$=_length] select');
                     length_sel.removeClass('form-control-sm');
                 });
             });
         })(jQuery);
     </script>

     {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
 @endsection
