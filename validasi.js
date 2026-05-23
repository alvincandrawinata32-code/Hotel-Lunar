document.getElementById('passwordForm').addEventListener('submit', function(event) {
    // Ambil elemen input dan pesan error
    const passInput = document.getElementById('password');
    const confirmInput = document.getElementById('confirm_password');
    const passError = document.getElementById('passError');
    const confirmError = document.getElementById('confirmError');

    let isValid = true;

    // 1. Validasi Panjang Password (Minimal 8 Karakter)
    if (passInput.value.length < 8) {
        passError.innerText = "Password minimal harus 8 karakter!";
        isValid = false;
    } else {
        passError.innerText = "";
    }

    // 2. Validasi Kesesuaian Konfirmasi Password
    if (passInput.value !== confirmInput.value) {
        confirmError.innerText = "Konfirmasi password tidak cocok!";
        isValid = false;
    } else {
        confirmError.innerText = "";
    }

    // Jika ada yang tidak valid, batalkan proses submit ke PHP
    if (!isValid) {
        event.preventDefault();
    }
});