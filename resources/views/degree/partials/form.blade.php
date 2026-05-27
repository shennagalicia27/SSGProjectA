<form method="POST" action="{{ $action }}" class="form-grid">
    @csrf
    @if($degree)
        @method('PUT')
    @endif

    <div>
        <label for="degree_title">Degree Title</label>
        <input id="degree_title" name="degree_title" type="text" value="{{ old('degree_title', $degree?->degree_title) }}" required>
    </div>

    <button type="submit" class="btn">{{ $buttonText }}</button>
</form>
