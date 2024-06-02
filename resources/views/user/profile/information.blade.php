<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Update Profile</div>
            <form action="{{ route('profile.store', $user->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('post')
                <div class="card-body">
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Full Name</label>
                        <div class="col-md-4 col-sm-4">
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- /.row --}}
                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-md-4 col-sm-4">
                            <input name="email" id="email" class="form-control input-mask"
                                data-inputmask="'alias': 'email'" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- /.row --}}
                    <div class="row mb-3">
                        <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-md-4 col-sm-4">
                            <input type="text" name="phone" id="phone" class="form-control"
                                value="{{ old('phone', $user->phone) }}" required>
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- /.row --}}
                    <div class="row mb-3">
                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-md-4 col-sm-4">
                            <input type="text" name="address" id="address" class="form-control"
                                value="{{ old('address', $user->address) }}" required>
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- /.row --}}
                    <div class="row mb-3">
                        <label for="country" class="col-sm-2 col-form-label">Country</label>
                        <div class="col-md-4 col-sm-4">
                            <input type="text" name="country" id="country" class="form-control"
                                value="{{ old('country', $user->country) }}" required>
                            @error('country')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- /.row --}}
                    <div class="row mb-3">
                        <label for="state" class="col-sm-2 col-form-label">State</label>
                        <div class="col-md-4 col-sm-4">
                            <input type="text" name="state" id="state" class="form-control"
                                value="{{ old('state', $user->state) }}" required>
                            @error('state')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- /.row --}}
                    <div class="row mb-3">
                        <label for="city" class="col-sm-2 col-form-label">City</label>
                        <div class="col-md-4 col-sm-4">
                            <input type="text" name="city" id="city" class="form-control"
                                value="{{ old('city', $user->city) }}" required>
                            @error('city')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- /.row --}}
                    <div class="row mb-3">
                        <label for="zip_code" class="col-sm-2 col-form-label">Postal / Zip Code</label>
                        <div class="col-md-4 col-sm-4">
                            <input type="text" name="zip_code" id="zip_code" class="form-control"
                                value="{{ old('zip_code', $user->zip_code) }}" required>
                            @error('zip_code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- /.row --}}
                </div>
                {{-- /.card-body --}}
                <div class="card-footer">
                    <x-form.button name="updateProfile" text="Update Profile" icon="ri-save-line" />
                </div>
            </form>
        </div>
        {{-- /.card --}}
    </div>
    {{-- /.col --}}
</div>
{{-- /.row --}}
