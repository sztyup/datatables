function drawTable() {
    @if ($datatable->ajax->pipeline > 0)
        oTable.clearPipeline().draw();
    @else
        oTable.draw();
    @endif
}

var search = $.fn.dataTable.util.throttle(
        function(event) {
            if (event.type == "keyup") {
                if (
                        event.keyCode == 37 ||
                        event.keyCode == 38 ||
                        event.keyCode == 39 ||
                        event.keyCode == 40 ||
                        event.keyCode == 16 ||
                        event.keyCode == 17 ||
                        event.keyCode == 18
                )
                    return;
            }

            oTable
                    .column($(event.currentTarget).data("search-column-index"))
                    .search($(this).val());
            drawTable();
        },
        options.searchDelay
);

$(selector).find("tr input.sg-datatables-individual-filtering").on("keyup change", search);

$(selector).find("tr select.sg-datatables-individual-filtering").on("keyup change", function(event) {
    var searchValue = $(this).val();
    searchValue = searchValue ? searchValue.toString() : '';
    oTable
            .column($(event.currentTarget).data("search-column-index"))
            .search(searchValue);
    drawTable();
});
