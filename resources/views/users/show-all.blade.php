@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-1 col-sm-10">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if(count($users))
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Provider</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->provider }}</td>
                            <td>
                                <ul>

                                    @foreach($user->roles as $role)
                                        <li>{{$role->name}}</li>
                                    @endforeach

                                </ul>
                            </td>
                            <td>
                                <button class="btn disabled btn-info"><i class="fa fa-edit"></i></button>
                                <button class="btn disabled btn-danger"><i class="fa fa-trash-o"></i></button>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
