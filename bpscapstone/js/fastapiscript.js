document.getElementById("predictForm").addEventListener("submit", async function(e) {
    e.preventDefault();
  
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData.entries());
  
    Object.keys(data).forEach(key => data[key] = parseFloat(data[key]));
  
    try {
      const res = await fetch("https://bpsfastapi-production.up.railway.app/predict", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
      });
  
      if (!res.ok) {
        throw new Error(`Server error: ${res.status}`);
      }
  
      const result = await res.json();
      document.getElementById("hasil").innerText = "Prediksi Penjualan: " + result.prediksi_penjualan;
    } catch (err) {
      document.getElementById("hasil").innerText = "Error: " + err;
    }
  });
  
