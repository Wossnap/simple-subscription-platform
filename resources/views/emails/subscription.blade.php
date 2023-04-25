<x-mail::message>

@foreach ($posts as $post)
<div align="right">Website: {{ $post->website->name }}</div>

# Title:  {{$post->title}}

<x-mail::panel>
    {{ $post->description}}
</x-mail::panel>

<x-mail::button url="{{$post->website->url}}">
Go to Website
</x-mail::button>
@endforeach


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
