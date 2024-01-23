<!DOCTYPE html>
<html lang="en">
<x-head title="{{ $post->title }} - Posts">
    <link rel="stylesheet" href="{{ asset('css/prism.css') }}">
    <script src="{{ asset('js/prism.js') }}"></script>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/a11y-dark.min.css">
    <script src="{{ asset('js/highlight.min.js') }}"></script> --}}
    <style>

        #output {
            white-space: pre-line;
        }
    </style>
</x-head>

<body>
    <div class="container-scroller">

        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div>
                    <a class="navbar-brand brand-logo" href="{{ url('/') }}">
                        <img src="{{ asset('images/logo.svg') }}" alt="logo" />
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}">
                        <img src="{{ asset('images/logo-mini.svg') }}" alt="logo" />
                    </a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img class="img-xs rounded-circle" src="{{ asset('images/faces/face8.jpg') }}"
                                alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="{{ asset('images/faces/face8.jpg') }}"
                                    alt="Profile image">
                                <p class="mb-1 mt-3 font-weight-semibold">{{ auth('admin')->user()->name }}</p>
                                <p class="fw-light text-muted mb-0">{{ auth('admin')->user()->email }}</p>
                            </div>
                            <a href="{{ route('logout') }}" class="dropdown-item"><i
                                    class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign
                                Out</a>
                        </div>
                    </li>
                </ul>

        </nav>



        <div class="container-fluid page-body-wrapper d-block">

            <div class="content-wrapper">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="display-3 mb-3 d-flex justify-content-center">{{ $post->title }}</div>
                            <img src="{{ asset('storage/' . $post->img) }}" alt="" class="rounded img-fluid">
                            <div class="d-flex justify-content-between my-4">
                                <div> Catagory : {{ $post->category->name }}</div>
                                <div>Sub Catagory : {{ $post->sub_category->name }}</div>
                            </div>
                            <div class="mt-3 text-xl-left">
                                {!! $post->description !!}
                            </div>
                            @foreach ($codes as $code)
                                <div class="mt-2">
                                    <div class="d-flex justify-content-between pe-4">
                                        <div class="card-title">{{ $code->title }}</div>
                                        <div>{{ $code->language }}</div>
                                    </div>
                                    <div class="mt-3 text-xl-left">
                                        {{ $code->description }}
                                    </div>
                                    <div class="line-numbers">
                                        
                                        <pre>
                                            <code class="language-{{ $code->language }}">

                                                    {{ $code->content }}

                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            @endforeach
                            <div>
                                <div class="display-4">Output:</div>
                                <pre>
                                <code id="output" class="language-text">
                                    {{ $post->output }}
                                </code>
                            </pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-footer />
        </div>
    </div>
    <x-scripts>
        <script type="text/javascript">
            $(document).ready(function() {
                $('pre[class*=language-].line-numbers').each(function(i, e) {
                    console.log(i);
                });
            });
        </script>
    </x-scripts>
</body>

</html>
