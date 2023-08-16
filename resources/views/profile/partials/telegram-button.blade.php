<section>
	<header>
		<h2 class="text-lg font-medium text-gray-900">
			{{ __('Add Telegram') }}
		</h2>
	</header>

	<script async src="https://telegram.org/js/telegram-widget.js?22"
		data-telegram-login="{{ env('TELEGRAM_BOT_NAME', '') }}" data-size="large"
		data-auth-url="{{ route('callbacks.telegram') }}" data-request-access="write"></script>

</section>
