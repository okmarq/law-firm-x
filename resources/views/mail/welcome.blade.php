<x-mail::message>
    # {{ config('app.name') }}

    Hello {{ $first_name }}!

    Your profile has been created successfully.

    We urge you to update your profile with your passport photograph.

    Update using the button below

    <x-mail::button :url="$url" color="success">
        Update
    </x-mail::button>

    Thanks,
    {{ config('app.name') }}
</x-mail::message>
