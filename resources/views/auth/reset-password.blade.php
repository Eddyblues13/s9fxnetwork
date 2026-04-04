<!DOCTYPE html>
<html lang="en">

<head>
    <title>S9fx Network | Reset Password</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="index, follow" />
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description"
        content="Reset your S9fx Network account password. Secure access to your binary options and forex investments.">
    <meta name="author" content="S9fx Network">
    <meta name="keywords" content="Password Reset, S9fx Network, Binary Options, Forex Trading">

    <meta name="theme-color" content="#e9e8f0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="auth/img/favicon.png" type="image/x-icon">
    <link rel="apple-touch-icon-precomposed" href="auth/img/favicon.png">

    <link rel="stylesheet" href="auth/css/vendors/uikit.min.css">
    <link rel="stylesheet" href="auth/css/style.css">
</head>

<body>
    <!-- preloader begin -->
    <div class="in-loader">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <!-- preloader end -->

    <main>
        <!-- section content begin -->
        <div class="uk-section uk-padding-remove-vertical">
            <div class="uk-container uk-container-expand">
                <div class="uk-grid" data-uk-height-viewport="expand: true">
                    <div class="uk-width-3-5@m uk-background-cover uk-background-center-right uk-visible@m uk-box-shadow-xlarge"
                        style="background-image: url(auth/img/in-signin-image.jpg);">
                    </div>
                    <div class="uk-width-expand@m uk-flex uk-flex-middle">
                        <div class="uk-grid uk-flex-center">
                            <div class="uk-width-3-5@m">
                                <div class="in-padding-horizontal@s">
                                    <!-- module logo begin -->
                                    <a class="uk-logo" href="index.php">
                                        <img class="in-offset-top-10" src="{{asset('image/logo.png')}}"
                                            data-src="{{asset('image/logo.png')}}" alt="logo" width="170" height="56"
                                            data-uk-img>
                                    </a>
                                    <!-- module logo begin -->
                                    <p class="uk-text-lead uk-margin-top uk-margin-remove-bottom">Reset Your Password
                                    </p>
                                    <p class="uk-text uk-margin-remove-top uk-margin-medium-bottom">Remember your
                                        password? <a href="{{ route('login') }}">Login here</a></p>

                                    <div id="form-messages">
                                        @if (session('status'))
                                        <div class="alert alert-success text-success" style="color: green;"
                                            role="alert">
                                            {{ session('status') }}
                                        </div>
                                        @endif
                                    </div>

                                    <form id="password-reset-form" method="POST"
                                        action="{{ route('password.update') }}">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $token }}">

                                        <div class="uk-margin-small uk-width-1-1 uk-inline">
                                            <span class="uk-form-icon uk-form-icon-flip fas fa-envelope fa-sm"></span>
                                            <input class="uk-input uk-border-rounded" name="email" id="email"
                                                type="email" placeholder="Email" required autocomplete="email"
                                                value="{{ $email ?? old('email') }}">
                                            <div class="invalid-feedback" id="email-error"></div>
                                        </div>

                                        <div class="uk-margin-small uk-width-1-1 uk-inline">
                                            <span class="uk-form-icon uk-form-icon-flip fas fa-lock fa-sm"></span>
                                            <input class="uk-input uk-border-rounded" id="password" type="password"
                                                placeholder="New Password" name="password" required
                                                autocomplete="new-password">
                                            <div class="invalid-feedback" id="password-error"></div>
                                        </div>

                                        <div class="uk-margin-small uk-width-1-1 uk-inline">
                                            <span class="uk-form-icon uk-form-icon-flip fas fa-lock fa-sm"></span>
                                            <input class="uk-input uk-border-rounded" id="password-confirm"
                                                type="password" placeholder="Confirm New Password"
                                                name="password_confirmation" required autocomplete="new-password">
                                            <div class="invalid-feedback" id="password_confirmation-error"></div>
                                        </div>

                                        <div class="uk-margin-small uk-width-1-1">
                                            <button
                                                class="uk-button uk-width-1-1 uk-button-primary uk-border-rounded uk-float-left"
                                                type="submit" id="reset-button">Reset Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- section content end -->
    </main>

    <style>
        .mgm {
            border-radius: 7px;
            position: fixed;
            z-index: 90;
            bottom: 45%;
            right: 50px;
            background: #fff;
            padding: 10px 27px;
            box-shadow: 0px 5px 13px 0px rgba(0, 0, 0, .3);
        }

        .mgm a {
            font-weight: 700;
            display: block;
            color: #8BC34A;
        }

        .mgm a,
        .mgm a:active {
            transition: all .2s ease;
            color: #8BC34A;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }

        .uk-input.uk-border-rounded.is-invalid {
            border-color: #dc3545;
        }
    </style>
    <div class="mgm" style="display: none;">
        <div class="txt" style="color:black;"></div>
    </div>

    <script src="auth/js/vendors/uikit.min.js"></script>
    <script src="auth/js/vendors/indonez.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // Handle form submission
            $('#password-reset-form').on('submit', function(e) {
                e.preventDefault();
                
                // Clear previous errors
                $('.invalid-feedback').text('');
                $('.uk-input').removeClass('is-invalid');
                
                // Show loading state
                $('#reset-button').prop('disabled', true);
                
                // Submit form via AJAX
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            // Show success message
                            $('#form-messages').html(
                                '<div class="alert alert-success text-success" style="color: green;" role="alert">' +
                                response.message +
                                '</div>'
                            );
                            
                            // Optionally redirect after delay
                            setTimeout(function() {
                                window.location.href = "{{ route('login') }}";
                            }, 2000);
                        }
                    },
                    error: function(xhr) {
                        $('#reset-button').prop('disabled', false);
                        
                        if (xhr.status === 422) {
                            // Validation errors
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('#' + key + '-error').text(value[0]);
                                $('[name="' + key + '"]').addClass('is-invalid');
                            });
                            
                            // Show error message if exists
                            if (xhr.responseJSON.message) {
                                $('#form-messages').html(
                                    '<div class="alert alert-danger text-danger" role="alert">' +
                                    xhr.responseJSON.message +
                                    '</div>'
                                );
                            }
                        } else {
                            // Other errors
                            $('#form-messages').html(
                                '<div class="alert alert-danger text-danger" role="alert">' +
                                'An error occurred. Please try again.' +
                                '</div>'
                            );
                        }
                    }
                });
            });

            // Notification system
            var listCountries = ['South Africa', 'USA', 'Germany', 'France', 'Italy', 'South Africa', 'Australia', 'South Africa', 'Canada', 'Argentina', 'Saudi Arabia', 'Mexico', 'South Africa', 'South Africa', 'Venezuela', 'South Africa', 'Sweden', 'South Africa', 'South Africa', 'Italy', 'South Africa', 'United Kingdom', 'South Africa', 'Greece', 'Cuba', 'South Africa', 'Portugal', 'Austria', 'South Africa', 'Panama', 'South Africa', 'South Africa', 'Netherlands', 'Switzerland', 'Belgium', 'Israel', 'Cyprus'];
            var listPlans = ['$500', '$1,500', '$1,000', '$10,000', '$2,000', '$3,000', '$4,000', '$600', '$700', '$2,500'];
            var transarray = ['just <b>invested</b>', 'has <b>withdrawn</b>', 'is <b>trading with</b>'];
            var interval = Math.floor(Math.random() * (40000 - 8000 + 1) + 8000);
            var run = setInterval(request, interval);

            function request() {
                clearInterval(run);
                interval = Math.floor(Math.random() * (40000 - 8000 + 1) + 8000);
                var country = listCountries[Math.floor(Math.random() * listCountries.length)];
                var transtype = transarray[Math.floor(Math.random() * transarray.length)];
                var plan = listPlans[Math.floor(Math.random() * listPlans.length)];
                var msg = 'Someone from <b>' + country + '</b> ' + transtype + ' <a href="javascript:void(0);" onclick="javascript:void(0);">' + plan + '</a>';
                $(".mgm .txt").html(msg);
                $(".mgm").stop(true).fadeIn(300);
                window.setTimeout(function() {
                    $(".mgm").stop(true).fadeOut(300);
                }, 10000);
                run = setInterval(request, interval);
            }
        });
    </script>
</body>

</html>