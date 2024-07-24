async function pay(data) {
    const response = await fetch('Payment/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });
    return response.json();
}

function paymentHandle(status, paymentData) {
    if (status == "success") {
        pay({ request: 'payment_complete', payment_id: paymentData.razorpay_payment_id, order_id: paymentData.razorpay_order_id, signature: paymentData.razorpay_signature }).then((resp) => {
            if (resp && resp.status == "success") {
                alert("Your Order is Confirmed");
                window.location.href="booking.php";
            }
            else {

            }
        });
    }
    else {
        pay({ request: 'payment_failed', error: paymentData.error.code, payment_id: paymentData.error.metadata.payment_id, order_id: paymentData.error.metadata.order_id }).then((resp) => {
            alert("Payment Failed, Please Try Again!");
        })
    }

}

function payRequest(payData) {
    pay(payData).then((resp) => {

        if (resp && resp.status == "success") {
            let data = resp.message;
            let options = {
                "key": "rzp_test_dLERjnDCg7ZB7k", // Enter the Key ID generated from the Dashboard
                "amount": data.amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                "currency": "INR",
                "name": "Platform Productions",
                "description": "Event Booking",
                "image": "https://deepakcardoza.com/logo.jpg",
                "order_id": data.order_id,
                "prefill": {
                    "name": data.name,
                    "email": data.email,
                    "contact": data.contact
                },
                "theme": {
                    "color": "#3399cc"
                },
                "handler": function (response) {
                    paymentHandle('success', response);
                }
            };

            var rzp1 = new Razorpay(options);

            rzp1.open();
            rzp1.on('payment.failed', function (response) {
                paymentHandle('failed', response);
            });
        }
        else if (resp && resp.status == "failed") {

        }
    })
}
window.onload = () => {

    document.querySelector('#pay').addEventListener('click', (e) => {

        var name = document.getElementById('event-name').value;
        var location = document.getElementById('event-location').value;
        var date = document.getElementById('event-date').value;
        var stime = document.getElementById('event-time1').value;
        var etime = document.getElementById('event-time2').value;
        var people = document.getElementById('people').value;

        if(name=="Other")
            name = document.getElementById('event-name-other').value;

        var checked = document.querySelectorAll('input:checked');

        var services = [];
        for (var checkbox of checked) {
            if (checkbox.checked) {
                services.push(checkbox.id);
            }
        }
    
 

            let payload = {
                request: 'payment',
                name: name.trim(),
                location: location.trim(),
                date: date,
                stime: stime,
                etime: etime,
                people: people,
                services: services
            }

            payRequest(payload)
    })
}