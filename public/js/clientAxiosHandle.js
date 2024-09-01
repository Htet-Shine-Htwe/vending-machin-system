function ajaxCallBack(uri, formData, successCallback, errorCallback) {
    return $.ajax({
        url: uri,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            successCallback(data);
        },
        error: function(errors) {
            errorCallback(errors);
        }
    });
}


function handleAxiosFormError(errors) {
    let response = errors.responseJSON;

    if (errors.status == 422) {
        let errors = response.errors;
        $.each(errors, function(field, message) {
            var error = message[0];
            $(" #" + field + "-error").html(error);
        });

    } else {
        if (response?.message?.length > 300) {
            response.message = response.message.substr(0, 300) + '...';
        }
    }
}

function resetValidationErrors(keys) {
    keys.forEach(function(key) {
        if (key.includes('[]')) {
            key = key.replace('[]', '');
        }
        $("#" + key + "-error").html("");
    });
}
