<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>urlshortner.online</title>
  <meta name="viewport" content="urlshortner.online Free short Url unlimited short link free">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #2563eb;
      --primary-light: #3b82f6;
      --dark: #1e293b;
      --light: #f8fafc;
      --gray: #94a3b8;
      --border: #e2e8f0;
      --success: #10b981;
      --error: #ef4444;
    }
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f1f5f9;
      color: var(--dark);
      line-height: 1.5;
      min-height: 100vh;
      display: grid;
      grid-template-rows: auto 1fr auto;
    }
    
    header {
      background: white;
      padding: 1.5rem;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    .logo {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      font-weight: 600;
      font-size: 1.25rem;
      color: var(--primary);
    }
    
    .logo-icon {
      width: 32px;
      height: 32px;
      background: var(--primary);
      color: white;
      border-radius: 6px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    main {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
    }
    
    .card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 480px;
      padding: 2.5rem;
      text-align: center;
    }
    
    h1 {
      font-size: 1.5rem;
      font-weight: 600;
      margin-bottom: 1.5rem;
      color: var(--dark);
    }
    
    .input-group {
      margin-bottom: 1.5rem;
    }
    
    input {
      width: 100%;
      padding: 0.875rem 1rem;
      border: 1px solid var(--border);
      border-radius: 8px;
      font-size: 1rem;
      margin-bottom: 1rem;
      transition: all 0.2s;
    }
    
    input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    
    button {
      background: var(--primary);
      color: white;
      border: none;
      padding: 0.875rem 1.5rem;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 500;
      cursor: pointer;
      width: 100%;
      transition: background 0.2s;
    }
    
    button:hover {
      background: var(--primary-light);
    }
    
    .result-container {
      margin-top: 1.5rem;
      display: none;
    }
    
    .result-box {
      display: flex;
      gap: 0.5rem;
      margin-bottom: 1rem;
    }
    
    .result-box input {
      background: var(--light);
      color: var(--dark);
      flex: 1;
    }
    
    .result-box button {
      width: auto;
      flex-shrink: 0;
    }
    
    .message {
      font-size: 0.875rem;
      margin-top: 0.5rem;
    }
    
    .success {
      color: var(--success);
    }
    
    .error {
      color: var(--error);
    }
    
    .login-prompt {
      margin-top: 2rem;
      font-size: 0.875rem;
      color: var(--gray);
    }
    
    .login-prompt a {
      color: var(--primary);
      text-decoration: none;
      font-weight: 500;
    }
    
    .login-prompt a:hover {
      text-decoration: underline;
    }
    
    footer {
      text-align: center;
      padding: 1.5rem;
      color: var(--gray);
      font-size: 0.875rem;
    }
    
    @media (max-width: 640px) {
      .card {
        padding: 1.5rem;
      }
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">
      <div class="logo-icon">U</div>
      <span>urlshortner.online</span>
    </div>
  </header>
  
  <main>
    <div class="card">
      <h1>Shorten Your Links</h1>
      
      <div class="input-group">
        <input type="text" id="guestLongUrl" placeholder="Paste your long URL here..." required>
        <button onclick="guestShorten()">Shorten URL</button>
      </div>
      
      <div id="guestResult" class="result-container">
        <div class="result-box">
          <input type="text" id="guestShortUrl" readonly>
          <button onclick="guestCopy()">Copy</button>
        </div>
        <p id="guestMsg" class="message"></p>
      </div>
      
      <p class="login-prompt">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle; margin-right: 4px;">
          <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
        </svg>
        For advanced features, <a href="login.php">login to your account</a>
      </p>
    </div>
  </main>
  
  <footer>
    &copy; 2023 Shortly URL Shortener. All rights reserved.
  </footer>

  <script>
    async function guestShorten() {
      const longUrl = document.getElementById("guestLongUrl").value.trim();
      const resultContainer = document.getElementById("guestResult");
      const message = document.getElementById("guestMsg");
      
      if (!longUrl) {
        message.textContent = "Please enter a valid URL";
        message.className = "message error";
        resultContainer.style.display = "block";
        return;
      }
      
      try {
        const res = await fetch("api/shorten.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ longUrl })
        });
        
        const data = await res.json();
        
        if (data.shortUrl) {
          document.getElementById("guestShortUrl").value = data.shortUrl;
          resultContainer.style.display = "block";
          message.textContent = "Your shortened URL is ready!";
          message.className = "message success";
        } else {
          resultContainer.style.display = "block";
          message.textContent = "Error: " + (data.error || "Something went wrong");
          message.className = "message error";
        }
      } catch (error) {
        resultContainer.style.display = "block";
        message.textContent = "Network error. Please try again.";
        message.className = "message error";
      }
    }

    function guestCopy() {
      const input = document.getElementById("guestShortUrl");
      input.select();
      document.execCommand("copy");
      
      const message = document.getElementById("guestMsg");
      message.textContent = "Copied to clipboard!";
      message.className = "message success";
      
      const copyBtn = event.target;
      copyBtn.textContent = "Copied!";
      setTimeout(() => {
        copyBtn.textContent = "Copy";
      }, 2000);
    }
  </script>
</body>
</html>