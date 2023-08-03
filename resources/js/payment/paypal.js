import axios from "axios";
import Api from "../api/Api";

const checkoutForm = document.getElementById("checkout-form");

paypal
    .Buttons({
        style: {
            color: "blue",
            shape: "pill",
            label: "pay",
            height: 40,
        },

        // Call your server to set up the transaction
        async createOrder(data, actions) {
            try {
                const formData = new FormData(checkoutForm);
                const response = await axios.post(
                    "/ajax/paypal/order/create",
                    formData
                );
                const orderData = await response.data;
                return orderData.vendor_order_id;
            } catch (error) {
                const response = error.response;

                if (response.headers["x-validated-view"] === "true") {
                    checkoutForm.innerHTML = response.data;
                    throw Error("Form validation failed!");
                }

                throw Error("An error occurred while processing your request!");
            }
        },

        // Call your server to finalize the transaction
        async onApprove(data, actions) {
            console.log(data);
            const response = await axios.post(
                `/ajax/paypal/order/${data.orderID}/capture`
            );
            console.log(response);
            const orderData = response.data;

            // Three cases to handle:
            //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
            //   (2) Other non-recoverable errors -> Show a failure message
            //   (3) Successful transaction -> Show confirmation or thank you

            // This example reads a v2/checkout/orders capture response, propagated from the server
            // You could use a different API or structure for your 'orderData'
            var errorDetail =
                Array.isArray(orderData.details) && orderData.details[0];

            if (errorDetail && errorDetail.issue === "INSTRUMENT_DECLINED") {
                return actions.restart(); // Recoverable state, per:
                // https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
            }

            if (errorDetail) {
                var msg = "Sorry, your transaction could not be processed.";
                if (errorDetail.description)
                    msg += "\n\n" + errorDetail.description;
                if (orderData.debug_id) msg += " (" + orderData.debug_id + ")";
                return alert(msg); // Show a failure message (try to avoid alerts in production environments)
            }

            // Successful capture! For demo purposes:
            window.location.href = `orders/${orderData.id}/success`;
        },
    })
    .render("#paypal-button-container");
