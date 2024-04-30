function openUpdatePopup(id) {
    var url = "update_product.php?id=" + id;
    window.open(url, "_blank", "width=600,height=400");
}

function openDeletePopup(id) {
    var url = "delete_product.php?id=" + id;
    window.open(url, "_blank", "width=400,height=200");
}