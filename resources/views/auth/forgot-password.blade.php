<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">

    <title>Login</title>
    @include('partials.head')
    @include('partials.site-js')
</head>
<body>
<!-- Page -->
<div class="container">
    <div class="authentication-wrapper authentication-basic container-p-y"
         style="max-width: 500px;margin: 0 auto;display: flex;align-items: center;justify-content: center">
        <div class="authentication-inner">
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-2">Forgot Password?</h4>
                    <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label class="fw-semibold">Email</label>
                            <input type="email" id="email" class="form-control block mt-1 w-full" name="email"
                                   value="{{old('email')}}">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class=" mt-4 ">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Email Password Reset Link') }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

@push('scripts')
    <script>
        $('#login-form').validate({
            rules: {
                email: {
                    required: true
                },
                password: {
                    required: true
                }
            }
        })
    </script>
@endpush
<style>
    body, html {
        height: 100%;
        margin: 0;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    .authentication-wrapper {
        max-width: 500px;
        margin: 0 auto;
        /* Remove 'display: flex;' */
        /* Remove 'align-items: center;' */
        /* Remove 'justify-content: center;' */
    }
</style>
