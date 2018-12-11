@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="display-4">Users List</h2>
        <div class="table-responsive-md">
            <table id="dtBasicExample" class="table table-bordered" >
                <thead>
                <tr>
                    <th class="th-sm" >#
                    </th>
                    <th class="th-sm" >Name
                    </th>
                    <th class="th-sm">Email
                    </th>
                    <th class="th-sm">Balance
                    </th>
                    <th class="th-sm">Registration Date
                    </th>
                    <th class="th-sm">Actions
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->balance }} PW</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            @if($user->trashed())
                                <a href="#" class="btn btn-sm btn-warning" onclick="event.preventDefault();
                                        document.getElementById('restore-form-{{ $user->id }}').submit();"><i class="fa fa-undo mr-1"></i> Restore</a>
                                <form id="restore-form-{{ $user->id }}" action="{{route('admin.user.restore', $user->id)}}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                @else
                                <a href="{{route('admin.user.edit', $user->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-edit mr-1"></i> Edit</a>
                                <a href="#" class="btn btn-sm btn-danger" onclick="event.preventDefault();
                                        document.getElementById('ban-form-{{ $user->id }}').submit();"><i class="fa fa-ban mr-1"></i> BAN</a>
                                <form id="ban-form-{{ $user->id }}" action="{{route('admin.user.ban', $user->id)}}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th class="th-sm" >#
                    </th>
                    <th class="th-sm" >Name
                    </th>
                    <th class="th-sm">Email
                    </th>
                    <th class="th-sm">Balance
                    </th>
                    <th class="th-sm">Registration Date
                    </th>
                    <th class="th-sm">Actions
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#dtBasicExample').DataTable({
                "order": [],
                "columnDefs": [
                    { "orderable": false, "targets": 5 },
                    { "searchable": false, "targets": 5 }
                ]
            });
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
@endsection