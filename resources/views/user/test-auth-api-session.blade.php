@extends('user.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Testing</div>

                    <div class="card-body">
                        Testing API
                    </div>
                </div>
            </div>
        </div>
    </div>

    <test-auth-api-session-component></test-auth-api-session-component>
@endsection
