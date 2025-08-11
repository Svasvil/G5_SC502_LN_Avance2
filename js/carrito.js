const fmtCRC = new Intl.NumberFormat("es-CR", { style: "currency", currency: "CRC", maximumFractionDigits: 0 });

function parseCRC(str) {
  if (!str) return 0;
  const onlyNums = (str + "").replace(/[^\d]/g, ""); 
  return Number(onlyNums || 0);
}

function renderPrecioCRC(valor) {
  return fmtCRC.format(valor);
}

(function cargarDesdeStorage() {
  const tbody = document.querySelector("tbody");
  if (!tbody) return;

  const guardados = JSON.parse(localStorage.getItem("cartItems") || "[]");
  if (guardados.length === 0) return;

  tbody.innerHTML = "";
  guardados.forEach(item => {
    const tr = document.createElement("tr");
    tr.className = "item-carrito";
    tr.innerHTML = `
      <td class="item-info">
        <img src="${item.img}" alt="${item.nombre}">
        <p>${item.nombre}</p>
      </td>
      <td class="precio-unitario">${renderPrecioCRC(item.precio)}</td>
      <td><input type="number" value="${item.cantidad}" min="1"></td>
      <td class="total-linea">${renderPrecioCRC(item.precio * item.cantidad)}</td>
      <td><button class="btn-eliminar">Eliminar</button></td>
    `;
    tbody.appendChild(tr);
  });
})();

function actualizarTotalFila(tr) {
  const precioCell = tr.querySelector(".precio-unitario");
  const qty = Number(tr.querySelector('input[type="number"]').value || 1);
  const precio = parseCRC(precioCell ? precioCell.textContent : "");
  const total = precio * qty;
  const totalCell = tr.querySelector(".total-linea");
  if (totalCell) totalCell.textContent = renderPrecioCRC(total);
  return total;
}

function recalcularTotales() {
  const filas = [...document.querySelectorAll("tr.item-carrito")];
  let subtotal = 0;
  filas.forEach(tr => { subtotal += actualizarTotalFila(tr); });

  const envio = subtotal > 0 ? 0 : 0; 
  document.getElementById("subtotal").textContent = renderPrecioCRC(subtotal);
  document.getElementById("envio").textContent = renderPrecioCRC(envio);
  document.getElementById("totalGeneral").textContent = renderPrecioCRC(subtotal + envio);

  guardarTablaEnStorage();
}

function guardarTablaEnStorage() {
  const filas = [...document.querySelectorAll("tr.item-carrito")];
  const items = filas.map(tr => {
    const nombre = tr.querySelector(".item-info p")?.textContent?.trim() || "";
    const img = tr.querySelector(".item-info img")?.getAttribute("src") || "";
    const precio = parseCRC(tr.querySelector(".precio-unitario")?.textContent || "");
    const cantidad = Number(tr.querySelector('input[type="number"]').value || 1);
    return { nombre, img, precio, cantidad };
  });
  localStorage.setItem("cartItems", JSON.stringify(items));
}

function eliminarFila(tr) {
  tr.remove();
  recalcularTotales();
}

document.addEventListener("input", (e) => {
  if (e.target.matches('tbody input[type="number"]')) {
    const tr = e.target.closest("tr.item-carrito");
    if (tr) {
      if (Number(e.target.value) < 1) e.target.value = 1;
      actualizarTotalFila(tr);
      recalcularTotales();
    }
  }
});

document.addEventListener("click", (e) => {
  if (e.target.matches(".btn-eliminar")) {
    const tr = e.target.closest("tr.item-carrito");
    if (tr) eliminarFila(tr);
  }

  if (e.target.closest(".btn-checkout")) {
    e.preventDefault();

    const items = JSON.parse(localStorage.getItem("cartItems") || "[]");
    if (!items.length) {
      alert("Tu carrito está vacío.");
      return;
    }

    const total = document.getElementById("totalGeneral").textContent;
    alert("Gracias por tu compra. Total: " + total);

    localStorage.removeItem("cartItems");   
    window.location.href = "productos.html"; 
  }
});


window.addEventListener("DOMContentLoaded", recalcularTotales);