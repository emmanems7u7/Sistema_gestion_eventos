@csrf



<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" id="nombre"
        value="{{ old('nombre', $servicio->nombre ?? '') }}" required>
    @error('nombre')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="descripcion" class="form-label">Descripcion</label>
    <textarea class="form-control @error('descripcion') is-invalid @enderror" name="descripcion"
        id="descripcion">{{ old('descripcion', $servicio->descripcion ?? '') }}</textarea>
    @error('descripcion')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="imagen" class="form-label">Imagen</label>
    <input type="file" class="form-control @error('imagen') is-invalid @enderror" name="imagen" id="imagen">
    @error('imagen')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @if(!empty($servicio?->imagen))
        <div class="mt-2">
            <p>{{ __('lo.imagen_actual') }}:</p>
            <img src="{{ asset('storage/' . $servicio->imagen) }}" width="120" class="rounded shadow">
        </div>
    @endif
</div>

<div class="alert alert-warning d-flex align-items-center" role="alert">
    <i class="fas fa-exclamation-triangle me-2"></i>
    <div>
        <strong>Atención:</strong> Debes asignar un <strong>rol</strong> al servicio para obtener al personal
        relacionado
        al servicio.
    </div>
</div>
<div class="form-group">
    <label for="role_id">Rol</label>
    <select name="role_id" id="role_id" class="form-control @error('role_id') is-invalid @enderror" required>
        <option value="">Seleccione un rol</option>
        @foreach(\Spatie\Permission\Models\Role::all() as $role)
            <option value="{{ $role->id }}" {{ (string) old('role_id', $servicio->role_id ?? '') === (string) $role->id ? 'selected' : '' }}>
                {{ ucfirst($role->name) }}
            </option>
        @endforeach
    </select>
    @error('role_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<button type="submit" class="btn btn-primary">{!!   __('ui.save') !!}</button>