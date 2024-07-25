document.getElementById('theme-selector').addEventListener('change', function() {
    var selectedTheme = this.value;
    if (selectedTheme === 'dark') {
      document.body.classList.add('dark-mode');
      document.body.classList.remove('blue-mode', 'green-mode','pink-mode','yellow-mode','red-mode');
    } else if (selectedTheme === 'blue') {
      document.body.classList.add('blue-mode');
      document.body.classList.remove('dark-mode', 'green-mode','pink-mode','yellow-mode','red-mode');
    } else if (selectedTheme === 'green') {
      document.body.classList.add('green-mode');
      document.body.classList.remove('dark-mode', 'blue-mode','pink-mode','yellow-mode','red-mode');
    } else if (selectedTheme === 'pink') {
      document.body.classList.add('pink-mode');
      document.body.classList.remove('dark-mode', 'blue-mode','green-mode','yellow-mode','red-mode');
    } else if (selectedTheme === 'yellow') {
      document.body.classList.add('yellow-mode');
      document.body.classList.remove('dark-mode', 'blue-mode','pink-mode','green-mode','red-mode');
    } else if (selectedTheme === 'red') {
      document.body.classList.add('red-mode');
      document.body.classList.remove('dark-mode', 'blue-mode','pink-mode','yellow-mode','green-mode');
    } else {
      document.body.classList.remove('dark-mode', 'blue-mode', 'green-mode','pink-mode','yellow-mode','red-mode');
    }
  });