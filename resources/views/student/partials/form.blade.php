<div class="form-grid two-column student-form" data-submit-url="{{ $submitUrl }}" data-submit-method="{{ $submitMethod }}">
    <div>
        <label for="fname">First Name</label>
        <input id="fname" name="fname" type="text" value="{{ old('fname', $student?->fname) }}" required>
        <p class="field-error" data-error-for="fname"></p>
    </div>
    <div>
        <label for="mname">Middle Name</label>
        <input id="mname" name="mname" type="text" value="{{ old('mname', $student?->mname) }}">
        <p class="field-error" data-error-for="mname"></p>
    </div>
    <div>
        <label for="lname">Last Name</label>
        <input id="lname" name="lname" type="text" value="{{ old('lname', $student?->lname) }}" required>
        <p class="field-error" data-error-for="lname"></p>
    </div>
    <div>
        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email', $student?->email) }}" required>
        <p class="field-error" data-error-for="email"></p>
    </div>
    <div>
        <label for="contactno">Contact Number</label>
        <input id="contactno" name="contactno" type="text" value="{{ old('contactno', $student?->contactno) }}" required>
        <p class="field-error" data-error-for="contactno"></p>
    </div>
    <div>
        <label for="degree_id">Degree</label>
        <select id="degree_id" name="degree_id" required>
            <option value="">Select Degree</option>
            @foreach($degrees as $degree)
                <option value="{{ $degree->id }}" @selected(old('degree_id', $student?->degree_id) == $degree->id)>{{ $degree->degree_title }}</option>
            @endforeach
        </select>
        <p class="field-error" data-error-for="degree_id"></p>
    </div>
    <div>
        <label for="username">Username</label>
        <input id="username" name="username" type="text" value="{{ old('username', $student?->userAccount?->username) }}" required>
        <p class="field-error" data-error-for="username"></p>
    </div>
    <div>
        <label for="password">Password {{ $student ? '(Leave blank to keep current)' : '' }}</label>
        <input id="password" name="password" type="password" {{ $student ? '' : 'required' }}>
        <p class="field-error" data-error-for="password"></p>
    </div>
    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" {{ $student ? '' : 'required' }}>
        <p class="field-error" data-error-for="password_confirmation"></p>
    </div>

    <div class="full-width">
        <div id="message"></div>
        <button type="button" class="btn" id="{{ $student ? 'editStudentBtn' : 'saveStudentBtn' }}">{{ $buttonText }}</button>
    </div>
</div>
