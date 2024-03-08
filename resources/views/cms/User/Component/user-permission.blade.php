@foreach ($permissions as $key => $value)
<div class="col-md-2">
    <div class="checkbox">
        <label>
            <input type="checkbox" id="{{ $value->id }}" value="{{ $value->name }}"
            @foreach ($userRoles as $keyR => $role)
               @foreach ($role->permissions as $i => $per)
               @if ($value->id == $per->id)
                        checked disabled
                @endif
               @endforeach
            @endforeach
            name="permissions[]"> {{ $value->name }}
        </label>
    </div>
</div>
@endforeach