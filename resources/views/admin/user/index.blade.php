@extends('layouts.admin')

@section('title')
    <i class="fas fa-users"></i> Users
@endsection

@section('content')
    <div class="block block-rounded block-bordered">
        <div class="block-header">
            <div class="block-options-simple">
                <a class="btn btn-primary btn-sm" href="{{ route('admin.users.create') }}"><i class="fas fa-plus"></i> Create</a>
            </div>
        </div>
        <div class="block-table">
            <table class="table">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="text-center">Registered</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->first_name}}</td>
                        <td>{{ $user->last_name}}</td>
                        <td>{{ $user->email}}</td>
                        <td>{{ $user->role->name }}</td>
                        <td class="text-center">{{ $user->created_at }}</td>
                        <td class="text-right">
                            <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}"><i class="fas fa-edit"></i></a>
                            @if(auth()->user()->id !== $user->id)
                                <a class="delete__confirm" href="#0" data-form-id="{{md5($user->id)}}"><i class="fas fa-times text-danger"></i></a>
                                <form id="{{md5($user->id)}}" action="{{ route('admin.users.destroy', ['user' => $user->id]) }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}{{ method_field('DELETE') }}
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection()

@section('script')
    <script>
        $('.delete__confirm').on('click', function (e) {
          e.preventDefault();

          var form = $(this).data('form-id');

          swal({
            title: "Are you sure?",
            text: "User {{ $user->first_name . ' ' . $user->last_name }} will be deleted.",
            icon: "warning",
            buttons: [true, 'Delete']
          }).then(function(value) {
            if (value) $('#' + form).submit();
          });
        })
    </script>
@endsection
