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
                var testresults = JSON.parse(xhr.responseText);

                // Insert the table header row
                var headerRow = table.insertRow();
                headerRow.innerHTML = '<th>Patient Name</th><th>Test Name</th><th>Test Date</th><th>Test Result</th><th></th>';

                for (var i = 0; i < testresults.length; i++) {
                    var testresult = testresults[i];
                    var row = table.insertRow();
                    row.insertCell().textContent = testresult.first_name + ' ' + testresult.last_name;
                    row.insertCell().textContent = testresult.test_name;
                    row.insertCell().textContent = testresult.test_date;
                    row.insertCell().textContent = testresult.test_result;

                    // Insert the "Edit" button cell
                    var editButtonCell = row.insertCell();
                    editButtonCell.innerHTML = '<button class="dashboard-table-button"><a href="edit_test.php?test_result_id=' + testresult.test_result_id + ' ">Edit</a></button>';
                }
            }
        }
    };

    // Open and send the AJAX request
    xhr.open('POST', '../models/test_results_search.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('search=' + search);
});