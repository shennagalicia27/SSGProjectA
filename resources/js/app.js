import './bootstrap';

window.$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            Accept: 'application/json',
        },
    });

    if ($('#studentsTableRegion').length) {
        loadStudentsTable($('#studentsTableRegion').data('url'));
    }

    $('#saveStudentBtn, #editStudentBtn').on('click', function (e) {
        e.preventDefault();
        submitStudentForm();
    });

    $(document).on('click', '.delete-student-btn', function (e) {
        e.preventDefault();

        const studentId = $(this).data('id');

        if (!studentId || !confirm('Delete this student?')) {
            return;
        }

        deleteStudent(studentId);
    });

    $(document).on('click', '#studentsTableRegion .pagination a', function (e) {
        e.preventDefault();
        loadStudentsTable($(this).attr('href'));
    });
});

function loadStudentsTable(url) {
    $.ajax({
        url,
        type: 'GET',
        success(response) {
            if (response.html) {
                $('#studentsTableRegion').html(response.html);
            }
        },
        error() {
            showMessage('Unable to load students.', 'error');
        },
    });
}

function submitStudentForm() {
    const form = $('.student-form');
    const submitUrl = form.data('submit-url');
    const submitMethod = form.data('submit-method');

    clearStudentFormErrors();

    $.ajax({
        url: submitUrl,
        type: submitMethod,
        data: {
            fname: $('#fname').val(),
            mname: $('#mname').val(),
            lname: $('#lname').val(),
            email: $('#email').val(),
            contactno: $('#contactno').val(),
            degree_id: $('#degree_id').val(),
            username: $('#username').val(),
            password: $('#password').val(),
            password_confirmation: $('#password_confirmation').val(),
        },
        success(response) {
            showMessage(response.message || 'Student saved successfully.', 'success');

            if (submitMethod === 'POST') {
                $('.student-form')
                    .find('input[type="text"], input[type="email"], input[type="password"]')
                    .val('');
                $('#degree_id').val('');
            }
        },
        error(xhr) {
            if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                showStudentFormErrors(xhr.responseJSON.errors);
                showMessage('Please fix the highlighted fields.', 'error');
                return;
            }

            showMessage('Request failed. Please try again.', 'error');
        },
    });
}

function deleteStudent(id) {
    $.ajax({
        url: `/student/${id}`,
        type: 'DELETE',
        success(response) {
            showMessage(response.message || 'Student deleted successfully.', 'success');
            loadStudentsTable($('#studentsTableRegion').data('url'));
        },
        error() {
            showMessage('Unable to delete student.', 'error');
        },
    });
}

function clearStudentFormErrors() {
    $('.field-error').text('');
}

function showStudentFormErrors(errors) {
    $.each(errors, function (field, messages) {
        $(`[data-error-for="${field}"]`).text(messages[0]);
    });
}

function showMessage(message, type) {
    const messageClass = type === 'success' ? 'alert-success' : 'alert-error';
    $('#message').html(`<div class="alert ${messageClass}">${message}</div>`);
}
