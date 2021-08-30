function secureBook(deskID, customerID, CheckInDate, checkOutDate, price) {
    if (confirm("Are you sure to Book from" + checkInDate + " to " + checkOutDate + "?") == true) {
        bookDesk(bookid);
    }
}
function bookDesk(deskID, customerID, CheckInDate, checkOutDate, price){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        alert(xmlhttp.responseText);

          
    }
    };
    xmlhttp.open("GET","bookDesk.php?TypeID="+deskID+"&CustomerID="+customerID+"&CheckIN="+CheckInDate+"&CheckOUT="+checkOutDate+"&Price="+price+"&Type=Desk",true);
    xmlhttp.send();
}