<div id="paypal-button-container"></div>

<script
	src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.' . env('PAYPAL_MODE') . '.client_id') }}&components=buttons&currency={{ config('paypal.currency') }}">
</script>

@vite(['resources/js/payment/paypal.js'])
