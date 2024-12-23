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
                        <div class="card-header bg-primary text-white">All User</div>
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
                                                    wire:click="chooseEdit({{ $user->id }})">Edit</button>
                                                <button
                                                    class="btn {{ $menu_list == 'delete' ? 'btn-danger' : 'btn-danger' }}"
                                                    wire:click="chooseDelete({{ $user->id }})">Delete</button>
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
                        <div class="card-header bg-success text-white">Add User</div>
                        <div class="card-body">
                            {{-- Form --}}
                            <form wire:submit="addUser">
                                {{-- Name & Email --}}
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control my-2"
                                            placeholder="Your Name" wire:model="name" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control my-2"
                                            placeholder="Your Email" wire:model="email" required>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Password & Role --}}
                                <div class="form-group row my-2">
                                    <div class="col-md-6">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control my-2"
                                            placeholder="Your Password" wire:model="password" required>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="role">Role</label>
                                        <select name="role" id="role" class="form-control my-2"
                                            wire:model="role" required>
                                            <option value="" selected>-- Role --</option>
                                            <option value="admin">Admin</option>
                                            <option value="cashier">Cashier</option>
                                        </select>
                                        @error('role')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Button Submit --}}
                                <div class="form-group row my-3">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-success">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @elseif($menu_list == 'edit')
                    {{-- Edit User --}}
                    <div class="card border-warning">
                        <div class="card-header bg-warning">Edit User</div>
                        <div class="card-body">
                            {{-- Form --}}
                            <form wire:submit="updateUser">
                                {{-- Name & Email --}}
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control my-2"
                                            placeholder="Your Name" wire:model="name" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control my-2"
                                            placeholder="Your Email" wire:model="email" required>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Password & Role --}}
                                <div class="form-group row my-2">
                                    <div class="col-md-6">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control my-2"
                                            placeholder="Your Password" wire:model="password">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="role">Role</label>
                                        <select name="role" id="role" class="form-control my-2"
                                            wire:model="role" required>
                                            <option value="" selected>-- Role --</option>
                                            <option value="admin">Admin</option>
                                            <option value="cashier">Cashier</option>
                                        </select>
                                        @error('role')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Button Submit --}}
                                <div class="form-group row my-3">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @elseif($menu_list == 'delete')
                    {{-- Delete User --}}
                    <div class="card border-danger">
                        <div class="card-header bg-danger text-white">Delete User</div>
                        <div class="card-body">
                            {{-- Confirmation --}}
                            Are you sure to delete the user?
                            <p>Name: {{ $user_choosed->name }}</p>
                            <button class="btn btn-danger" wire:click="deleteUser">Delete</button>
                            <button class="btn btn-secondary" wire:click="cancel">Cancel</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
