function openUpdatePopup(id) {
    var url = "update_product.php?id=" + id;
    window.open(url, "_blank", "width=600,height=400");
}

function openDeletePopup(id) {
    var url = "delete_product.php?id=" + id;
    window.open(url, "_blank", "width=400,height=200");
}

function updateQuantity(foodId, newQuantity) {
    console.log("Updating quantity for food ID:", foodId, "to quantity:", newQuantity);
    // Send an AJAX request to update the quantity in the database
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_quantity.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                console.log("Response from server:", xhr.responseText);
                // Parse response to get new total price for the item
                var totalItemPrice = parseFloat(xhr.responseText);
                console.log("Total item price:", totalItemPrice);
                if (!isNaN(totalItemPrice)) {
                    // Update the total price displayed for the item
                    var totalElementId = 'total_price_' + foodId;
                    var totalElement = document.getElementById(totalElementId);
                    if (totalElement) {
                        totalElement.innerText = 'Total Price: ' + totalItemPrice.toFixed(2);
                    }

                    // Calculate new overall total price by summing up all item prices
                    var overallTotalPrice = 0;
                    var itemDivs = document.querySelectorAll('div[id^="total_price_"]');
                    itemDivs.forEach(function(itemDiv) {
                        var itemPrice = parseFloat(itemDiv.innerText.split(':')[1].trim());
                        if (!isNaN(itemPrice)) {
                            overallTotalPrice += itemPrice;
                        }
                    });

                    // Update the overall total price displayed
                    var overallTotalPriceElement = document.getElementById('overall_total_price');
                    if (overallTotalPriceElement) {
                        overallTotalPriceElement.innerText = 'Total Price: ' + overallTotalPrice.toFixed(2);
                    }
                } else {
                    console.error("Invalid total item price received from server.");
                }
            } else {
                console.error("Error:", xhr.status, xhr.statusText);
            }
        }
    };
    xhr.send("food_id=" + foodId + "&quantity=" + newQuantity);
}
