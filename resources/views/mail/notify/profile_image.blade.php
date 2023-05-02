<x-mail::message>
# {{ config('app.name') }}

Hello {{ $first_name }}!

We are yet to see your passport photograph.

Please update your profile with your passport photograph.

Update using the button below
<x-mail::button :url="$url" color="success">
Update
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
