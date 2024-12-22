<div>
    <div class="container">
        <div class="row my-3">
            <div class="col">
                <button class="btn {{ $menu_list == 'see' ? 'btn-primary' : 'btn-outline-primary' }}"
                    wire:click="chooseMenu('see')">All User</button>
                <button class="btn {{ $menu_list == 'add' ? 'btn-primary' : 'btn-outline-primary' }}"
                    wire:click="chooseMenu('add')">Add User</button>
                <button class="btn btn-info" wire:loading>Loading ...</button>
            </div>
        </div>

        {{-- All Functionality --}}
        <div class="row">
            <div class="col">
                @if ($menu_list == 'see')
                    {{-- See User --}}
                    <div class="card border-primary">
                        <div class="card-header">All User</div>
                        <div class="card-body">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Verified</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    {{-- Get User From Database --}}
                                    @foreach ($all_user as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $user->email_verified_at ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $user->email_verified_at ? 'Verified' : 'Not Verified' }}
                                                </span>
                                            </td>
                                            <td>{{ $user->role }}</td>
                                            <td>
                                                <button
                                                    class="btn {{ $menu_list == 'edit' ? 'btn-warning' : 'btn-warning' }}"
                                                    wire:click="chooseMenu('edit')">Edit</button>
                                                <button
                                                    class="btn {{ $menu_list == 'delete' ? 'btn-danger' : 'btn-danger' }}"
                                                    wire:click="chooseMenu('delete')">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @elseif($menu_list == 'add')
                    {{-- Add User --}}
                    <div class="card border-primary">
                        <div class="card-header">Add User</div>
                        <div class="card-body">
                            {{--  --}}
                        </div>
                    </div>
                @elseif($menu_list == 'edit')
                    {{-- Edit User --}}
                    <div class="card border-primary">
                        <div class="card-header">Edit User</div>
                        <div class="card-body">
                            {{--  --}}
                        </div>
                    </div>
                @elseif($menu_list == 'delete')
                    {{-- Delete User --}}
                    <div class="card border-primary">
                        <div class="card-header">Delete User</div>
                        <div class="card-body">
                            {{--  --}}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
