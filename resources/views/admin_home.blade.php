@extends('layouts.app')
@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/toastr.css') }}" />
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h2>Pending User List</h2>

                    <table id="user_table"
                        class="table table-borderless table-nowrap table-align-middle card-table text-center"
                        style="width:100% !important;">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody-light">
                            @forelse ($users as $key => $user)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <button class="btn btn-success approve-user"
                                        data-user_id="{{ $user->id }}">Accept</button>
                                    <button class="btn btn-danger decline-user"
                                        data-user_id="{{ $user->id }}">Decline</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan=" 4" class="text-center">No unapproved users found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script src="{{ asset('js/custom_admin.js') }}"></script>

@endsection
