<div class="col-12 mb-3">
    <div class="form-group">
        <label for="id_number">ID Number</label>
        <input type="text" name="id_number" id="id_number" class="form-control"
            value="{{ old('id_number') }}" required>
    </div>
    @error('id_number')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
{{-- /.col --}}
<div class="col-12 mb-3">
    <div class="form-group">
        <label for="id_proof_front">ID Proof Front</label>
        <input type="file" name="id_proof_front" id="id_proof_front" class="form-control"
            value="{{ old('id_proof_front') }}" required>
    </div>
    @error('id_proof_front')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
{{-- /.col --}}
<div class="col-12 mb-3">
    <div class="form-group">
        <label for="id_proof_back">ID Proof Back</label>
        <input type="file" name="id_proof_back" id="id_proof_back" class="form-control"
            value="{{ old('id_proof_back') }}" required>
    </div>
    @error('id_proof_back')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
{{-- /.col --}}