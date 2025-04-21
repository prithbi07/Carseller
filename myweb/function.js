function redirectUser(event) {
    event.preventDefault(); // Prevent form from submitting normally
    const role = document.getElementById("role").value;

    if (role === "owner") {
        window.location.href = "./ownerpage.html"; // change to your actual page
    } else if (role === "customer") {
        window.location.href = "./frontpage.html"; // change to your actual page
    } else {
        alert("Please select a valid role.");
    }
}
function redirectCustomer(event) {
    event.preventDefault(); // Prevent form reload
    const action = document.getElementById("action").value;

    if (action === "buy") {
        window.location.href = "http://localhost/myweb/buy_car.php";
    } else if (action === "test_drive") {
        window.location.href = "http://localhost/myweb/book_test_drive.php";
    } else {
        alert("Please select an option.");
    }
}