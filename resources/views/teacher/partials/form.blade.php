<form method="POST" action="{{ $action }}" class="form-grid two-column">
    @csrf
    @if($teacher)
        @method('PUT')
    @endif

    <div>
        <label for="fname">First Name</label>
        <input id="fname" name="fname" type="text" value="{{ old('fname', $teacher?->fname) }}" required>
    </div>
    <div>
        <label for="mname">Middle Name</label>
        <input id="mname" name="mname" type="text" value="{{ old('mname', $teacher?->mname) }}">
    </div>
    <div>
        <label for="lname">Last Name</label>
        <input id="lname" name="lname" type="text" value="{{ old('lname', $teacher?->lname) }}" required>
    </div>
    <div>
        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email', $teacher?->email) }}" required>
    </div>
    <div>
        <label for="contactno">Contact Number</label>
        <input id="contactno" name="contactno" type="text" value="{{ old('contactno', $teacher?->contactno) }}" required>
    </div>
    <div>
        <label for="username">Username</label>
        <input id="username" name="username" type="text" value="{{ old('username', $teacher?->userAccount?->username) }}" required>
    </div>
    <div>
        <label for="password">Password {{ $teacher ? '(Leave blank to keep current)' : '' }}</label>
        <input id="password" name="password" type="password" {{ $teacher ? '' : 'required' }}>
    </div>
    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" {{ $teacher ? '' : 'required' }}>
    </div>

    <div class="full-width">
        <button type="submit" class="btn">{{ $buttonText }}</button>
    </div>
</form>
