document.addEventListener("DOMContentLoaded", () => {
  const btn = document.getElementById("btn-agregar-carrito");
  if (!btn) return;

  btn.addEventListener("click", () => {
    const nombre = document.querySelector(".titulo-producto")?.textContent?.trim() || "Producto";
    const precioText = document.querySelector(".precio")?.textContent || "CRC 0";
    const precio = (precioText.match(/\d+/g) || []).join("") * 1; 
    const img = document.querySelector(".imagen-producto img")?.getAttribute("src") || "";

    const cart = JSON.parse(localStorage.getItem("cartItems") || "[]");

    const indice = cart.findIndex(it => it.nombre === nombre);
    if (indice >= 0) {
      cart[indice].cantidad = Number(cart[indice].cantidad || 1) + 1;
    } else {
      cart.push({ nombre, img, precio, cantidad: 1 });
    }

    localStorage.setItem("cartItems", JSON.stringify(cart));

    window.location.href = "carrito.html";
  });
});