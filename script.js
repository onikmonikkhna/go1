async function shorten() {
  const longUrl = document.getElementById("longUrl").value.trim();
  if (!longUrl) {
    alert("URL দিন!");
    return;
  }

  try {
    const res = await fetch("api/shorten.html", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ longUrl })
    });

    const data = await res.json();
    if (data.shortUrl) {
      document.getElementById("shortUrlDisplay").value = data.shortUrl;
      document.getElementById("resultBox").style.display = "block";
      document.getElementById("message").innerText = "✅  Short link created.!";
    } else {
      document.getElementById("message").innerText = "❌ Error: " + data.error;
    }
  } catch {
    document.getElementById("message").innerText = "⚠️ Network error!";
  }
