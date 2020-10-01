function pesquisarVoluntario (event) {
    // Declare variables
    var input, filter, tbody, tr, td, i, txtValue;
    input = document.getElementById("pesquisaVoluntarios");
    filter = input.value.toUpperCase();
    tbody = document.getElementById("tableVoluntarios");
    tr = tbody.getElementsByTagName("tr");

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        txtValue = td.textContent || td.innerText;

        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }
}

document.querySelector("#pesquisaVoluntarios").onkeyup = pesquisarVoluntario;