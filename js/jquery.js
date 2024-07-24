$(document).ready(function () {
    $('#event-name-other').hide();

    $('.add-to-cart').click(function () {
        var checked = document.querySelectorAll('input:checked');
        if (checked.length == 0) {
            alert("No Services Selected");
        }
        else {
            $('#eventInfo').modal('show');
        }

    });
    $('#event-name').click(function () {
        console.log($(this).val());
        if ($(this).val() == "Other")
            $('#event-name-other').show();
        else
            $('#event-name-other').hide();
    });
    $('#continue').click(function () {
        var checked = document.querySelectorAll('input:checked');

        var services = [];
        for (var checkbox of checked) {
            if (checkbox.checked) {
                services.push(checkbox.id);
            }
        }
        //console.log(services);
        var name = document.getElementById('event-name').value;
        var location = document.getElementById('event-location').value;
        var date = document.getElementById('event-date').value;
        var stime = document.getElementById('event-time1').value;
        var etime = document.getElementById('event-time2').value;
        var people = document.getElementById('people').value;

        if (name == "" || location == "" || date == "" || stime == "" || etime == "" || people == "") {
            $('#error').text('Please fill all the required fields!');
            $('#error').delay(5000).fadeOut();
        }
        //Check date is free or not ---------Pending
        else {
            $.post("ajax.php", {
                request: "add",
                serviceid: services,
                date: date
            },
                function (data, status) {
                    //alert("Data: " + data + "\nStatus: " + status);

                    if (data == "Booking Restricted") {
                        $('#error').show();
                        $('#error').text('Restricted Booking for the selected Date');
                        $('#error').delay(5000).fadeOut();
                    }
                    else if(data.includes("Maximum"))
                    {
                        $('#error').show();
                        $('#error').text(data);
                        $('#error').delay(5000).fadeOut();
                    }
                    else {
                        console.log(data);
                        console.log(typeof(data));

                        var final = new Array();
                        final = jQuery.parseJSON(data);

                        var str = "";
                        var amount = 0;
                        for (i = 0; i < final.length; i++) {
                            str = str + final[i][0] + " - ₹" + final[i][1];
                            str = str + "<br>";
                            amount += parseInt(final[i][1]);
                        }

                        $('#eventInfo').modal('hide');
                        $('#paymentConfirmation').modal('show');
                        document.getElementById('printServices').innerHTML = str;
                        document.getElementById('printAmount').innerHTML = "Total - ₹" + amount;
                    }

                });
        }
    });
    $('.label-add').click(function () {

    });

});