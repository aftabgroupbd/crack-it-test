<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Crack It | {{$title}}</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{asset('assets/favicon.ico')}}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet" />
        @yield('extra_css')
    </head>
    <body id="page-top">
        <!-- Navigation-->
        @include('layouts.header')
        <!-- About-->
        <section class="page-section bg-primary" >
            <div class="container px-4 px-lg-5">
                @yield('body')
            </div>
        </section>
        <!-- Footer-->
        @include('layouts.footer')
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        {{-- <script src="{{asset('assets/js/scripts.js')}}"></script> --}}
        
        <script>
            const logout = () => {
                if(confirm("Are you sure you want to logout?")){
                    var url = '{{route('logout')}}';
                    window.location = url;
                }
            }
        </script>
            @yield('extra_js')
    </body>
</html>
