<x-mail::message>
# Dear **{{ $user->name }}**

Thank you for registing your account with us at **{{ config('app.name') }}**.

Please click the button below to activate your account.

<x-mail::button :url="$url">
Activate My Account
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
