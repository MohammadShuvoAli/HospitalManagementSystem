function validateAddAppointmentForm() {
    var patientId = document.getElementById("patient_id");
    var appointmentDate = document.getElementById("appointment_date");
    var appointmentTime = document.getElementById("appointment_time");
    var errorMessages = document.getElementById("error_messages");

    // Reset error messages
    errorMessages.innerHTML = "";

    if (patientId.value === "" || appointmentDate.value === "" || appointmentTime.value === "") {
        if (patientId.value === "" && appointmentDate.value === "" && appointmentTime.value === "") {
            errorMessages.innerHTML = "Please select a patient, appointment date, and appointment time.";
        } else if (patientId.value === "" && appointmentDate.value === "") {
            errorMessages.innerHTML = "Please select a patient and appointment date.";
        } else if (patientId.value === "" && appointmentTime.value === "") {
            errorMessages.innerHTML = "Please select a patient and appointment time.";
        } else if (appointmentDate.value === "" && appointmentTime.value === "") {
            errorMessages.innerHTML = "Please select an appointment date and appointment time.";
        } else if (patientId.value === "") {
            errorMessages.innerHTML = "Please select a patient.";
        } else if (appointmentDate.value === "") {
            errorMessages.innerHTML = "Please select an appointment date.";
        } else {
            errorMessages.innerHTML = "Please select an appointment time.";
        }
        return false;
    }

    return true;
}

function validateAddPatientForm() {
    var firstName = document.getElementById("first_name").value;
    var lastName = document.getElementById("last_name").value;
    var dob = document.getElementById("date_of_birth").value;
    var gender = document.querySelector('input[name="gender"]:checked');
    var address = document.getElementById("address").value;
    var phone = document.getElementById("phone").value;
    var email = document.getElementById("email").value;
    var errorMessages = document.getElementById("error_messages");

    // Reset error messages
    errorMessages.innerHTML = "";

    var errorMessage = "";
    if (firstName === "") {
        errorMessage += "Please enter first name.<br>";
    }

    if (lastName === "") {
        errorMessage += "Please enter last name.<br>";
    }

    if (dob === "") {
        errorMessage += "Please select date of birth.<br>";
    }

    if (!gender) {
        errorMessage += "Please select gender.<br>";
    }

    if (address === "") {
        errorMessage += "Please enter address.<br>";
    }

    if (phone === "") {
        errorMessage += "Please enter phone number.<br>";
    }

    if (email === "") {
        errorMessage += "Please enter email address.<br>";
    }

    // Show error message(s) in error_messages element
    if (errorMessage !== "") {
        errorMessages.innerHTML = errorMessage;
        return false;
    }

    // If all validations pass, submit the form
    return true;
}

function validateAddPrescriptionForm() {
    var appointmentId = document.getElementById("appointment_id").value;
    var patientId = document.getElementById("patient_id").value;
    var medicineName = document.getElementById("medicine_name").value;
    var dosage = document.getElementById("dosage").value;
    var duration = document.getElementById("duration").value;
    var errorMessages = document.getElementById("error_messages");

    // Reset error messages
    errorMessages.innerHTML = "";

    var errorMessage = "";
    if (appointmentId === "") {
        errorMessage += "Please select an appointment.<br>";
    }

    if (patientId === "") {
        errorMessage += "Please select a patient.<br>";
    }

    if (medicineName === "") {
        errorMessage += "Please enter a medicine name.<br>";
    }

    if (dosage === "") {
        errorMessage += "Please enter a dosage.<br>";
    }

    if (duration === "") {
        errorMessage += "Please enter a duration.<br>";
    }

    // Show error message(s) in error_messages element
    if (errorMessage !== "") {
        errorMessages.innerHTML = errorMessage;
        return false;
    }
    return true;
}

function validateAddReportForm() {
    var patientId = document.getElementById("patient_id").value;
    var reportDate = document.getElementById("report_date").value;
    var reportDetails = document.getElementById("report_details").value;
    var errorMessages = document.getElementById("error_messages");

    // Reset error messages
    errorMessages.innerHTML = "";

    var errorMessage = "";
    if (patientId === "") {
        errorMessage += "Please select a patient.<br>";
    }

    if (reportDate === "") {
        errorMessage += "Please select a report date.<br>";
    }

    if (reportDetails === "") {
        errorMessage += "Please enter report details.<br>";
    }

    // Show error message(s) in error_messages element
    if (errorMessage !== "") {
        errorMessages.innerHTML = errorMessage;
        return false;
    }
    return true;
}

function validateAddTestForm() {
    var patientId = document.getElementById("patient_id").value;
    var testName = document.getElementById("test_name").value;
    var testDate = document.getElementById("test_date").value;
    var errorMessages = document.getElementById("error_messages");

    // Reset error messages
    errorMessages.innerHTML = "";

    var errorMessage = "";
    if (patientId === "") {
        errorMessage += "Please select a patient.<br>";
    }

    if (testName === "") {
        errorMessage += "Please enter a test name.<br>";
    }

    if (testDate === "") {
        errorMessage += "Please select a test date.<br>";
    }

    // Show error message(s) in error_messages element
    if (errorMessage !== "") {
        errorMessages.innerHTML = errorMessage;
        return false;
    }
    return true;
}


function validateChangePasswordForm() {
    var currentPassword = document.getElementsByName("current_password")[0].value;
    var newPassword = document.getElementsByName("new_password")[0].value;
    var confirmPassword = document.getElementsByName("confirm_password")[0].value;
    var errorMessages = document.getElementById("error_messages");

    // Reset error messages
    errorMessages.innerHTML = "";

    var errorMessage = "";
    if (currentPassword === "") {
        errorMessage += "Please enter the current password.<br>";
    }

    if (newPassword === "") {
        errorMessage += "Please enter a new password.<br>";
    } else if (newPassword.length < 8) {
        errorMessage += "New password must be at least 8 characters.<br>";
    }

    if (confirmPassword === "") {
        errorMessage += "Please confirm the new password.<br>";
    } else if (newPassword !== confirmPassword) {
        errorMessage += "New password and confirm password do not match.<br>";
    }

    // Show error message(s) in error_messages element
    if (errorMessage !== "") {
        errorMessages.innerHTML = errorMessage;
        return false;
    }
    return true;
}


function validateForgetPasswordForm() {
    var email = document.getElementById("email").value;
    var errorMessages = document.getElementById("error_messages");

    // Reset error messages
    errorMessages.innerHTML = "";

    var errorMessage = "";
    if (email === "") {
        errorMessage += "Please enter your email.<br>";
    }

    // Show error message(s) in error_messages element
    if (errorMessage !== "") {
        errorMessages.innerHTML = errorMessage;
        return false;
    }
    return true;
}

function validateLoginForm() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var errorMessages = document.getElementById("error_messages");

    // Reset error messages
    errorMessages.innerHTML = "";

    var errorMessage = "";
    if (username === "" && password === "") {
        errorMessage += "Please enter username and password.<br>";
    } else {
        if (username === "") {
            errorMessage += "Please enter username.<br>";
        }

        if (password === "") {
            errorMessage += "Please enter password.<br>";
        }
    }

    // Show error message(s) in error_messages element
    if (errorMessage !== "") {
        errorMessages.innerHTML = errorMessage;
        return false;
    }
    return true;
}

function validateReferralsForm() {
    var patientId = document.getElementById("patient_id").value;
    var doctorId = document.getElementById("doctor_id").value;
    var errorMessages = document.getElementById("error_messages");
    
    // Reset error messages
    errorMessages.innerHTML = "";
    
    var errorMessage = "";
    if (patientId === "") {
        errorMessage += "Please select a patient.<br>";
    }

    if (doctorId === "") {
        errorMessage += "Please select a doctor.<br>";
    }

    // Show error message(s) in error_messages element
    if (errorMessage !== "") {
        errorMessages.innerHTML = errorMessage;
        return false;
    }
    return true;
}

function validateRegisterForm() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var email = document.getElementById("email").value;
    var role = document.getElementById("role").value;
    var first_name = document.getElementById("first_name").value;
    var last_name = document.getElementById("last_name").value;
    var dob = document.getElementById("date_of_birth").value;
    var gender = document.querySelector('input[name="gender"]:checked');
    var address = document.getElementById("address").value;
    var phone = document.getElementById("phone").value;
    var errorMessages = document.getElementById("error_messages");

    // Reset error messages
    errorMessages.innerHTML = "";

    var errorMessage = "";
    if (username === "") {
        errorMessage += "Please enter username.<br>";
    }

    if (password === "") {
        errorMessage += "Please enter password.<br>";
    }

    if (email === "") {
        errorMessage += "Please enter email.<br>";
    }

    if (role === "") {
        errorMessage += "Please select a role.<br>";
    }

    if (dob === "") {
        errorMessage += "Please enter date of birth.<br>";
    }

    if (first_name === "") {
        errorMessage += "Please enter first name.<br>";
    }

    if (last_name === "") {
        errorMessage += "Please enter last name.<br>";
    }

    if (!gender) {
        errorMessage += "Please select gender.<br>";
    }

    if (address === "") {
        errorMessage += "Please enter address.<br>";
    }

    if (phone === "") {
        errorMessage += "Please enter phone.<br>";
    }

    // Show error message(s) in error_messages element
    if (errorMessage !== "") {
        errorMessages.innerHTML = errorMessage;
        return false;
    }
    return true;
}

function validateResetPasswordForm() {
    var email = document.getElementById("email").value;
    var errorMessages = document.getElementById("error_messages");

    // Reset error messages
    errorMessages.innerHTML = "";

    var errorMessage = "";
    if (email === "") {
        errorMessage += "Please enter email.<br>";
    }

    // Show error message(s) in error_messages element
    if (errorMessage !== "") {
        errorMessages.innerHTML = errorMessage;
        return false;
    }
    return true;
}
