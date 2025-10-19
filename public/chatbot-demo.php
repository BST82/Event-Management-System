<!-- Chatbot Button & Popup -->
<div id="chatbot-container">
  <button id="chatbot-toggle">💬 Chat</button>
  <div id="chatbot-box">
    <div id="chatbot-header">Event Assistant</div>
    <div id="chatbot-messages"></div>
    <div id="chatbot-input-area">
      <input type="text" id="chatbot-input" placeholder="Ask me anything...">
      <button id="chatbot-send">Send</button>
    </div>
  </div>
</div>

<style>
#chatbot-container { position: fixed; bottom: 20px; right: 20px; z-index: 9999; }
#chatbot-toggle { background-color: #8e44ad; color: white; border: none; border-radius: 50px; padding: 12px 18px; cursor: pointer; font-size: 16px; box-shadow: 0 5px 15px rgba(0,0,0,0.3); }
#chatbot-box { display: none; width: 320px; max-height: 450px; background: white; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.3); overflow: hidden; display: flex; flex-direction: column; margin-bottom: 10px; }
#chatbot-header { background-color: #6a11cb; color: white; padding: 10px; font-weight: bold; text-align: center; }
#chatbot-messages { flex: 1; padding: 10px; overflow-y: auto; }
#chatbot-input-area { display: flex; border-top: 1px solid #ccc; }
#chatbot-input { flex: 1; border: none; padding: 10px; }
#chatbot-send { background-color: #6a11cb; color: white; border: none; padding: 10px 15px; cursor: pointer; }
.message { margin-bottom: 8px; border-radius: 8px; padding: 6px 10px; }
.user { background-color: #dfe6e9; text-align: right; }
.ai { background-color: #6a11cb; color: white; }
.choice-btn { background: #fff; color: #6a11cb; border: 1px solid #6a11cb; border-radius: 20px; padding: 5px 10px; margin: 2px; cursor: pointer; font-size: 12px; }
.choice-btn:hover { background: #6a11cb; color: #fff; }
</style>

<script>
const toggleBtn = document.getElementById('chatbot-toggle');
const chatbotBox = document.getElementById('chatbot-box');
const sendBtn = document.getElementById('chatbot-send');
const inputField = document.getElementById('chatbot-input');
const messagesDiv = document.getElementById('chatbot-messages');

toggleBtn.addEventListener('click', () => {
  chatbotBox.style.display = chatbotBox.style.display === 'flex' ? 'none' : 'flex';
});
sendBtn.addEventListener('click', sendMessage);
inputField.addEventListener('keypress', function(e){
  if(e.key === 'Enter'){ sendMessage(); }
});

function appendMessage(text, sender){
  const div = document.createElement('div');
  div.classList.add('message', sender);
  div.innerHTML = text;
  messagesDiv.appendChild(div);
  messagesDiv.scrollTop = messagesDiv.scrollHeight;
}

// Demo chatbot conversation flow
const demoFlow = {
  "start": ["Hello! I'm your Event Assistant. How can I help you today? Choose an option below."],
  "options": ["Upcoming Events", "Filter by Location", "Help & FAQ"],
  "Upcoming Events": ["We have a Tech Meetup on 25th Oct and a Music Festival on 28th Oct."],
  "Filter by Location": ["You can filter events by City: Pune, Delhi, Mumbai."],
  "Help & FAQ": ["You can ask me anything about events like date, location, registration, etc."]
};

function showChoices(choices){
  const container = document.createElement('div');
  choices.forEach(choice=>{
    const btn = document.createElement('button');
    btn.textContent = choice;
    btn.classList.add('choice-btn');
    btn.onclick = () => {
      appendMessage(choice, 'user');
      showBotResponse(choice);
    };
    container.appendChild(btn);
  });
  messagesDiv.appendChild(container);
  messagesDiv.scrollTop = messagesDiv.scrollHeight;
}

function showBotResponse(userChoice){
  const responses = demoFlow[userChoice] || ["Sorry, I don't understand."];
  responses.forEach(resp => appendMessage(resp, 'ai'));

  if(userChoice === "start"){
    showChoices(demoFlow.options);
  }
}

showBotResponse("start");

function sendMessage(){
  const text = inputField.value.trim();
  if(!text) return;
  appendMessage(text, 'user');
  inputField.value = '';

  if(demoFlow[text]){
    showBotResponse(text);
  } else {
    appendMessage("I am here to help! Choose an option below.", 'ai');
    showChoices(demoFlow.options);
  }
}
</script>
