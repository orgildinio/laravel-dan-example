<x-mail::message>

Сайн байна уу, {{$user->name}}

Таны <strong>№{{$complaint->serial_number}}</strong> дугаартай гомдол <strong>{{$complaint->status->name}}</strong> төлөвт орсон байна.

Та доорх холбоос дээр дарж дэлгэрэнгүй мэдээллийг харах боломжтой.

<x-mail::button :url="$complaint_url">
Харах
</x-mail::button>

Баярлалаа,<br>
{{ config('app.name') }}
</x-mail::message>