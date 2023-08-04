// Attach an event listener to the search input field
document.getElementById('searchInput').addEventListener('input', function () {
    // Get the search query from the input field
    var search = this.value;
    if (search === '') {
        // Clear the previous search results
        var table = document.getElementById('searchResults');
        table.innerHTML = '';
        return; // Exit the function early if search query is empty
    }
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Clear the previous search results
                var table = document.getElementById('searchResults');
                table.innerHTML = '';

                // Parse the JSON response and loop through the fetched patient data
                var patients = JSON.parse(xhr.responseText);

                // Insert the table header row
                var headerRow = table.insertRow();
                headerRow.innerHTML = '<th>Patient Name</th><th>Date of Birth</th><th>Gender</th><th>Address</th><th>Phone</th><th>Email</th><th></th>';

                for (var i = 0; i < patients.length; i++) {
                    var patient = patients[i];
                    var row = table.insertRow();
                    row.insertCell().textContent = patient.first_name + ' ' + patient.last_name;
                    row.insertCell().textContent = patient.date_of_birth;
                    row.insertCell().textContent = patient.gender;
                    row.insertCell().textContent = patient.address;
                    row.insertCell().textContent = patient.phone;
                    row.insertCell().textContent = patient.email;

                    // Insert the "Edit" button cell
                    var editButtonCell = row.insertCell();
                    editButtonCell.innerHTML = '<button class="dashboard-table-button"><a href="edit_patient.php?patient_id=' + patient.patient_id + ' ">Edit</a></button>';
                }
            }
        }
    };

    // Open and send the AJAX request
    xhr.open('POST', '../models/live_patient_search.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('search=' + search);
});