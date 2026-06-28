(function () {
    'use strict';

    function togglePassword(e) {
        var button = e.currentTarget;
        var targetId = button.getAttribute('data-target');
        if (!targetId) return;

        var input = document.getElementById(targetId);
        if (!input) return;

        var isPassword = input.getAttribute('type') === 'password';
        input.setAttribute('type', isPassword ? 'text' : 'password');

        var icon = button.querySelector('i');
        if (icon) {
            icon.className = isPassword ? 'bi bi-eye-slash' : 'bi bi-eye';
        }

        var label = isPassword ? 'Sembunyikan password' : 'Tampilkan password';
        button.setAttribute('aria-label', label);
        button.setAttribute('title', label);
    }

    function initPasswordToggles() {
        var buttons = document.querySelectorAll('.password-toggle');
        for (var i = 0; i < buttons.length; i++) {
            buttons[i].addEventListener('click', togglePassword);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initPasswordToggles);
    } else {
        initPasswordToggles();
    }
})();
