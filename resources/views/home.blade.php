@extends('layouts.app')

@section('content')
<body class="bg-image" style= "background-image: url('https://images.squarespace-cdn.com/content/v1/615b1c3397012e292b69d5d3/ae425906-03cc-4d0b-b6c9-f9dbb0123c96/Lineup.png?format=2500w'); height: 100v;">
 <div class="header-menu-bg theme-bg--primary"><div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Welcome Volunteer!') }}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class= "text-center">
    <img src = "https://images.squarespace-cdn.com/content/v1/615b1c3397012e292b69d5d3/46440191-5388-43e3-a82d-228c522211b8/DSC_4637.jpg?format=750w"><!--make it cover the middle so we can put the welcome volunteers over it-->
    </div>
</body>
@endsection
