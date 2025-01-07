@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Chat with {{ $friend->name }}</h1>
        <div class="messages">
            @foreach ($messages as $message)
                <div class="message">
                    <strong>{{ $message->sender->name }}:</strong> {{ $message->content }}
                </div>
            @endforeach
        </div>
        <form method="POST" action="{{ route('messages.send', ['friend_id' => $friend->id]) }}">
            @csrf
            <div class="form-group">
                <label for="content">Message</label>
                <textarea id="content" name="content" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>

    </div>
@endsection

<script src="{{ asset('js/app.js') }}"></script>
<script>
    const chat = document.getElementById('chat');
    const messagesContainer = document.getElementById('messages');
    const messageForm = document.getElementById('message-form');
    const messageInput = document.getElementById('message-input');

    Echo.private('chat.{{ $friend->id }}')
        .listen('MessageSent', (e) => {
            messagesContainer.innerHTML += `
                <div class="message received">
                    <strong>${e.message.sender.name}:</strong> ${e.message.content}
                </div>
            `;
            chat.scrollTop = chat.scrollHeight;
        });

    messageForm.addEventListener('submit', (e) => {
        e.preventDefault();
        axios.post('/messages/{{ $friend->id }}', {
            content: messageInput.value
        }).then(response => {
            messagesContainer.innerHTML += `
                <div class="message sent">
                    <strong>You:</strong> ${messageInput.value}
                </div>
            `;
            messageInput.value = '';
            chat.scrollTop = chat.scrollHeight;
        });
    });
</script>
