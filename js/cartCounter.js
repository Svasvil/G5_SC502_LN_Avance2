(function () {
    function getCount() {
        var raw = localStorage.getItem('carrito');
        if (!raw) return 0;
        try {
            var arr = JSON.parse(raw) || [];
            var n = 0; for (var i = 0; i < arr.length; i++) { n += parseInt(arr[i].cantidad || 1); }
            return n;
        } catch (e) { return 0; }
    }
    function renderCount() {
        var el = document.getElementById('cartCount');
        if (!el) return;
        el.textContent = getCount();
    }
    renderCount();
    window.addEventListener('storage', function (e) { if (e.key === 'carrito') renderCount(); });
    window.addEventListener('focus', renderCount);
    document.addEventListener('visibilitychange', function () { if (!document.hidden) renderCount(); });
})();


// esto es un metodo buscado por aparte para decoracion