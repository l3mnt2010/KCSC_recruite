function toggleActive(element) {
    var elements = document.querySelectorAll('.pokemon_pic');
    elements.forEach(function(el) {
        el.classList.remove('nes-input');
    });
    element.classList.add('nes-input');
}