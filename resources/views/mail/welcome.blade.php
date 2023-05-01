<x-mail::message>
# {{ $app_name }}

Hello {{ $first_name }}!

Your profile has been created successfully.

Update using the button below
<x-mail::button :url="$url" color="success">
Update
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
