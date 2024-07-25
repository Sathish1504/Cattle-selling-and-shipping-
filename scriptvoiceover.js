// Function to speak the text of the current page
function speakPageTitle() {
    // Get the title of the page
    const pageTitle = document.title.trim();
    // Speak the title of the page
    const utterance = new SpeechSynthesisUtterance(pageTitle + ' opened');
    speechSynthesis.speak(utterance);
}

// Speak the page title when the page is loaded
window.addEventListener('load', speakPageTitle);

// Function to speak the text of the clicked link or button
function speakText(event) {
    // Get the text content of the clicked element
    const textContent = event.target.textContent.trim();
    // Speak the text content of the clicked element
    const utterance = new SpeechSynthesisUtterance('' + textContent);
    speechSynthesis.speak(utterance);
}

// Attach click event listeners to all <a> elements on the page
document.querySelectorAll('a').forEach(function(link) {
    link.addEventListener('click', speakText);
});

// Attach click event listeners to all <button> elements on the page
document.querySelectorAll('button').forEach(function(button) {
    button.addEventListener('click', speakText);
});