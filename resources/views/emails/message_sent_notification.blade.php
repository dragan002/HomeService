
<!DOCTYPE html>
<html>
<head>
    <title>New Message Notification</title>
</head>
<body>
    <h1>You have a new message from {{ $sender->name }}</h1>
    <p>{{ $messageContent->message }}</p>
</body>
</html>