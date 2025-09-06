// public/js/basic.js

document.addEventListener("DOMContentLoaded", function () {
    const header = document.querySelector("header");
    const nav = document.createElement("nav");
    nav.classList.add("main-nav");
    nav.innerHTML = `
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#quote">Quote</a></li>
            <li><a href="#couple">Mempelai</a></li>
            <li><a href="#story">Kisah</a></li>
            <li><a href="#event">Acara</a></li>
            <li><a href="#gallery">Galeri</a></li>
            <li><a href="#gift">Hadiah</a></li>
            <li><a href="#rsvp">RSVP</a></li>
            <li><a href="#guestbook">Ucapan</a></li>
        </ul>
    `;
    document.body.prepend(nav); // Tambahkan nav ke body

    // Fungsi untuk menampilkan/menyembunyikan navigasi
    function toggleStickyNav() {
        if (window.scrollY > header.offsetHeight / 2) {
            nav.classList.add("show");
        } else {
            nav.classList.remove("show");
        }
    }

    window.addEventListener("scroll", toggleStickyNav);
    toggleStickyNav(); // Panggil saat load untuk cek posisi awal

    // Smooth scroll untuk navigasi
    nav.querySelectorAll("a").forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();

            const targetId = this.getAttribute("href");
            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                const offsetTop =
                    targetElement.offsetTop - (nav.offsetHeight + 20); // Sedikit offset dari nav
                window.scrollTo({
                    top: offsetTop,
                    behavior: "smooth",
                });
            }
        });
    });

    // RSVP Form Submission (Contoh sederhana, ini akan mengirim ke action form)
    const rsvpForm = document.getElementById("rsvp-form");
    if (rsvpForm) {
        rsvpForm.addEventListener("submit", function (e) {
            // e.preventDefault(); // Jangan prevent default jika ingin form tetap submit ke backend

            // Contoh validasi sederhana
            const name = rsvpForm.querySelector('[name="name"]').value;
            const status = rsvpForm.querySelector(
                '[name="attendance_status"]'
            ).value;
            const message = rsvpForm.querySelector('[name="message"]').value;

            if (!name || !status || !message) {
                alert("Harap lengkapi semua bidang.");
                // return; // Aktifkan ini jika ingin mencegah submit
            }

            // Jika Anda ingin AJAX submission, Anda akan membatalkan default dan
            // mengirim fetch request di sini.
            // Contoh AJAX (uncomment jika ingin AJAX):
            /*
            e.preventDefault();
            const formData = new FormData(rsvpForm);
            fetch(rsvpForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Terima kasih, konfirmasi Anda telah terkirim!');
                    rsvpForm.reset();
                    // Anda bisa menambahkan data ke guestbook section secara dinamis di sini
                } else {
                    alert('Terjadi kesalahan: ' + (data.message || 'Silakan coba lagi.'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengirim konfirmasi.');
            });
            */
        });
    }

    // Copy to Clipboard untuk Nomor Rekening
    document.querySelectorAll("#gift p span").forEach((span) => {
        span.style.cursor = "pointer";
        span.title = "Klik untuk menyalin";
        span.addEventListener("click", function () {
            const accountNumber = this.innerText;
            navigator.clipboard
                .writeText(accountNumber)
                .then(() => {
                    alert("Nomor rekening disalin: " + accountNumber);
                })
                .catch((err) => {
                    console.error("Gagal menyalin:", err);
                });
        });
    });

    // Image Lightbox (sederhana, hanya untuk galeri)
    const galleryImages = document.querySelectorAll("#gallery img");
    if (galleryImages.length > 0) {
        const lightbox = document.createElement("div");
        lightbox.id = "lightbox";
        lightbox.style.cssText = `
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 10000;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        `;
        document.body.appendChild(lightbox);

        const lightboxImg = document.createElement("img");
        lightboxImg.style.cssText = `
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
            transform: scale(0.8);
            transition: transform 0.3s ease-out;
        `;
        lightbox.appendChild(lightboxImg);

        galleryImages.forEach((image) => {
            image.addEventListener("click", () => {
                lightbox.style.display = "flex";
                lightboxImg.src = image.src;
                // Animate in
                setTimeout(
                    () => (lightboxImg.style.transform = "scale(1)"),
                    50
                );
            });
        });

        lightbox.addEventListener("click", () => {
            // Animate out
            lightboxImg.style.transform = "scale(0.8)";
            setTimeout(() => (lightbox.style.display = "none"), 300);
        });
    }
});
