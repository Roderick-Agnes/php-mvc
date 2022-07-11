// Call the dataTables jQuery plugin
$(document).ready(function () {
  // Increment a counter for each row
  $("#dataTable").DataTable({
    "order": [[0, 'desc']]
  });
});
