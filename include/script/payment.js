function confirmBooking()
{
    if(confirm("Thank you for Booking this package"))
    {
        document.getElementById("bookingForm").submit();
        window.location.href("payment.php");
        return false;

    }else
    {
        return false;
    }
}