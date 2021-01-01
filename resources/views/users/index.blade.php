@extends('layouts.app')

@section('content')
<div class="container">
    <h5>Users: </h5>
    <div class="table-active d-inline-block m-3 border border-dark">
        <div class="square m-3 p-1 table-primary">User is admin and moderator</div>
        <div class="square m-3 p-1 table-success">User is admin</div>
        <div class="square m-3 p-1 table-warning">User is moderator</div>
        @if (Auth::user()->hasRole('owner'))
            <div class="square m-3 p-1 table-danger">It is you (be carefull and not delete yourself)</div>
        @endif
    </div>


    <div class="table-responsive border border-dark">
        <table class="table table-active table-stripped table-bordered">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">User name</th>
                    <th scope="col">set moderator</th>
                    <th scope="col">set admin</th>
                    <th scope="col">delete user</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    @if((!$user->hasRole('owner') && !Auth::user()->hasRole('owner')) || (Auth::user()->hasRole('owner')))
                    @can('update', $user)
                        <tr
                            class="
                                @if ($user->hasRole('owner')) table-danger
                                @elseif ($user->hasRole('admin') && $user->hasRole('moderator')) table-primary
                                @elseif ($user->hasRole('admin')) table-success
                                @elseif ($user->hasRole('moderator')) table-warning @endif
                            "
                        >
                            <th scope="row">
                                {{ $user->id }}
                            </th>

                            <td>
                                {{ $user->name }}
                            </td>
                            <td>
                                @if ($user->hasRole('moderator'))
                                    <form action="{{ route('users.update', ['user' => $user, 'action' => 'undo-moderator']) }}" method="post">
                                        @csrf
                                        @method('put')

                                        <button class="btn btn-primary">
                                            undo moderator
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('users.update', ['user' => $user, 'action' => 'set-moderator']) }}" method="post">
                                        @csrf
                                        @method('put')

                                        <button class="btn btn-primary">
                                            set moderator
                                        </button>
                                    </form>
                                @endif
                            </td>

                            <td>
                                @if ($user->hasRole('admin'))
                                    <form action="{{ route('users.update', ['user' => $user, 'action' => 'undo-admin']) }}" method="post">
                                        @csrf
                                        @method('put')

                                        <button class="btn btn-primary">
                                            undo admin
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('users.update', ['user' => $user, 'action' => 'set-admin']) }}" method="post">
                                        @csrf
                                        @method('put')

                                        <button class="btn btn-primary">
                                            set admin
                                        </button>
                                    </form>
                                @endif
                            </td>

                            <td>
                                @can ('delete', $user)
                                    <form action="{{ route('users.destroy', ['user' => $user]) }}" method="post">
                                        @csrf
                                        @method('delete')

                                        <button class="btn btn-danger">
                                            delete
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endcan
                    @endif

                @endforeach

            </tbody>
        </table>
    </div>
</div>

@endsection
