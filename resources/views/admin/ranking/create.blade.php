@extends('components.layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Create New Ranking',
        'breadcrumbs' => [
            ['text' => 'Dashboard', 'link' => route('admin.dashboard')],
            ['text' => 'View List', 'link' => route('admin.rankings.index')],
            ['text' => 'Create', 'link' => null],
        ],
    ])

    {{-- Create Form --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('admin.rankings.store') }}" method="POST" class="needs-validation" novalidate
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-5 col-sm-12">
                                <div class="form-group">
                                    <label for="icon">Icon</label>
                                    <input type="file" name="icon" id="icon" class="form-control"
                                        value="{{ old('icon') }}">
                                </div>
                                @error('icon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-1 col-sm-12">
                                <div class="form-group">
                                    <label for="level">Level</label>
                                    <input type="number" name="level" id="level" class="form-control"
                                        value="{{ old('level') }}" min="1" max="99" required>
                                </div>
                                @error('level')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name') }}" maxlength="255" required>
                                </div>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label for="bonus_point">Bonus Points</label>
                                    <input type="number" name="bonus_point" id="bonus_point" class="form-control"
                                        value="{{ old('bonus_point') }}" maxlength="7" required>
                                </div>
                                @error('bonus_point')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select id="is_active" name="is_active" class="form-control">
                                        <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>Enable</option>
                                        <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Disabled
                                        </option>
                                    </select>
                                </div>
                                @error('is_active')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                        </div>
                        {{-- /.row --}}

                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <div class="form-group">
                                    <label for="reward">Reward</label>
                                    <input type="text" name="reward" id="reward" class="form-control"
                                        value="{{ old('reward') }}" maxlength="255">
                                </div>
                                @error('reward')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="reward_image">Reward Image</label>
                                    <input type="file" name="reward_image" id="reward_image" class="form-control"
                                        value="{{ old('reward_image') }}">
                                </div>
                                @error('reward_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                        </div>
                        {{-- /.row --}}
                    </div>
                    {{-- /.card-body --}}
                    <div class="card-footer">
                        <x-form.button />
                        <x-form.button-save-view />
                        <x-form.button-save-create-new />
                    </div>
                    {{-- /.card-footer --}}
                </form>
            </div>
            {{-- /.card --}}
        </div>
        {{-- /.col --}}
    </div>
    {{-- /.row --}}
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
