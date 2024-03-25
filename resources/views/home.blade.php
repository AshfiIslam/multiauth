@extends('layouts.app')

@section('content')
    <div class="container">
        @php
            use App\Models\User;
            $users = User::all();
        @endphp
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            <a href="{{url('accept',$item->id)}}" class="btn btn-primary">Accept</a>
                                            <a href="{{url('deny',$item->id)}}" class="btn btn-danger">Deny</a>
                                            {{-- <a href="{{route('/deny')}}" class="btn btn-danger">Deny</a> --}}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
