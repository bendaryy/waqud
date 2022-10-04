  @if (Route::is('users.create'))
      <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
          <div>
              {{ $logo }}
          </div>

          <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
              {{ $slot }}
          </div>
      </div>
  @else
      <!DOCTYPE html>
      <html lang="en">

      <head>
          <!-- Required meta tags -->
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <title>Corona Admin</title>
          <!-- plugins:css -->
          <link rel="stylesheet" href="{{ asset('backend/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
          <link rel="stylesheet" href="{{ asset('backend/assets/vendors/css/vendor.bundle.base.css') }}">
          <!-- endinject -->
          <!-- Plugin css for this page -->
          <!-- End plugin css for this page -->
          <!-- inject:css -->
          <!-- endinject -->
          <!-- Layout styles -->
          <link rel="stylesheet" href="{{ asset('backend/assets/css/modern-vertical/style.css') }}">
          <!-- End layout styles -->
          <link rel="shortcut icon" href="{{ asset('images/waqud.png') }}" />
      </head>

      <body>
          <div class="container-scroller">
              <div class="container-fluid page-body-wrapper full-page-wrapper">
                  <div class="content-wrapper d-flex align-items-center auth lock-full-bg">
                      <div class="row w-100">
                          <div class="col-lg-4 mx-auto">
                              <div class="auth-form-transparent text-start p-5 text-center">
                                  {{-- <img src="{{ asset('backend/assets/images/faces/face13.jpg') }}" class="lock-profile-img" alt="img"> --}}

                                  <x-jet-validation-errors class="mb-4" />

                                  @if (session('status'))
                                      <div class="mb-4 font-medium text-sm text-green-600">
                                          {{ session('status') }}
                                      </div>
                                  @endif
                                  <form method="POST" action="{{ route('login', app()->getLocale()) }}">
                                      @csrf

                                      <div class="form-group">
                                          <label for="examplePassword1"
                                              style="font-weight: bold">{{ __('messages.Email') }}</label>
                                          <input class="form-control text-center" id="examplePassword1" type="email"
                                              name="email" :value="old('email')" required autofocus>
                                      </div>
                                      <div class="form-group">
                                          <label for="password"
                                              style="font-weight: bold">{{ __('messages.password') }}</label>
                                          <input class="form-control text-center" id="password" type="password"
                                              name="password" :value="old('password')" required autofocus>
                                      </div>
                                      <div class="mt-5">
                                          <button class="btn btn-block btn-success btn-lg font-weight-medium"
                                              type="submit"> {{ __('messages.login') }}</button>

                                          {{-- <x-jet-button class="btn btn-block btn-success btn-lg font-weight-medium">
                                        {{ __('messages.login') }}
                                    </x-jet-button> --}}
                                      </div>
                                      {{-- <div class="mt-3 text-center">
                                    <a href="#" class="auth-link text-white">Sign in using a different account</a>
                                </div> --}}
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- content-wrapper ends -->
              </div>
              <!-- page-body-wrapper ends -->
          </div>
          <!-- container-scroller -->
          <!-- plugins:js -->
          <script src="{{ asset('backend/assets/vendors/js/vendor.bundle.base.js') }}"></script>
          <!-- endinject -->
          <!-- Plugin js for this page -->
          <!-- End plugin js for this page -->
          <!-- inject:js -->
          <script src="{{ asset('backend/assets/js/off-canvas.js') }}"></script>
          <script src="{{ asset('backend/assets/js/hoverable-collapse.js') }}"></script>
          <script src="{{ asset('backend/assets/js/misc.js') }}"></script>
          <script src="{{ asset('backend/assets/js/settings.js') }}"></script>
          <script src="{{ asset('backend/assets/js/todolist.js') }}"></script>
          <!-- endinject -->
      </body>

      </html>

  @endif
