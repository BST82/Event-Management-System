<?php
header('Content-Type: application/json');

// Get the user message
$input = json_decode(file_get_contents('php://input'), true);
$userMessage = $input['message'] ?? '';

// Demo responses
$responses = [
    "Hello! 👋 I'm your Event Assistant.",
    "We have upcoming events this week. Check the dashboard!",
    "You can filter events by location using the search bar.",
    "Don't forget to register for events you like!",
    "Feel free to ask me anything about your events."
];

// Pick a random response for demo purposes
$reply = $responses[array_rand($responses)];

// Return JSON
echo json_encode(['reply' => $reply]);
