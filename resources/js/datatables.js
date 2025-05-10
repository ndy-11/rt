$(document).ready(function () {
    const tableId = '.data-table'; // Use a class selector for multiple tables if needed

    if (typeof $.fn.DataTable === 'undefined') {
        console.error("DataTables library is not loaded.");
        return;
    }

    $(tableId).each(function () {
        const table = $(this);

        // Destroy the existing DataTable instance if it exists
        if ($.fn.DataTable.isDataTable(table[0])) {
            table.DataTable().destroy();
        }

        // Initialize the DataTable
        table.DataTable({
            "responsive": true,
            "aLengthMenu": [
                [20, 30, 50, 75, -1],
                [20, 30, 50, 75, "All"]
            ],
            "pageLength": 20,
            "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">',
            "columnDefs": [{
                "targets": 'no-sort',
                "orderable": false,
            }]
        });
    });
});
