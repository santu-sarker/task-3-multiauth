@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <p>Your registration is pending approval from admin.</p>
                    <p>please be patient we will notify you.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
