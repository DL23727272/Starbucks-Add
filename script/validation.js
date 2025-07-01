 $(document).ready(function () {
    var customerID = sessionStorage.getItem('customerID');

    if (customerID) {
        // You can log the customerID for debugging if needed
        console.log("Customer is logged in. ID:", customerID);
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'Not Logged In',
            text: 'You need to log in to access this page.',
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            timer: 1500
        }).then(() => {
            window.location.href = 'index'; // Redirect to login
        });
    }
});
