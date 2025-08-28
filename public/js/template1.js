document.addEventListener("DOMContentLoaded", () => {
    // --- Personalisasi Nama Tamu ---
    const urlParams = new URLSearchParams(window.location.search);
    const guestName = urlParams.get("to") || "Tamu Undangan";
    document.getElementById("guest-name").textContent = guestName.replace(
        /\+/g,
        " "
    );

    // --- Efek Partikel di Cover ---
    const canvas = document.getElementById("particle-canvas");
    if (canvas) {
        const ctx = canvas.getContext("2d");
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        let particles = [];
        const particleCount = 100;

        class Particle {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.size = Math.random() * 2 + 1;
                this.speedX = Math.random() * 1 - 0.5;
                this.speedY = Math.random() * 1 - 0.5;
                this.opacity = Math.random() * 0.5 + 0.5;
            }
            update() {
                this.x += this.speedX;
                this.y += this.speedY;
                if (this.x < 0 || this.x > canvas.width) this.speedX *= -1;
                if (this.y < 0 || this.y > canvas.height) this.speedY *= -1;
            }
            draw() {
                ctx.fillStyle = `rgba(255, 255, 255, ${this.opacity})`;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fill();
            }
        }

        function initParticles() {
            for (let i = 0; i < particleCount; i++) {
                particles.push(new Particle());
            }
        }

        function animateParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            for (let i = 0; i < particles.length; i++) {
                particles[i].update();
                particles[i].draw();
            }
            requestAnimationFrame(animateParticles);
        }

        initParticles();
        animateParticles();

        window.addEventListener("resize", () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            particles = [];
            initParticles();
        });
    }

    // --- Buka Undangan ---
    const openButton = document.getElementById("open-invitation");
    const cover = document.getElementById("cover");
    const mainContent = document.getElementById("main-content");
    const audio = document.getElementById("background-music");
    const musicToggleButton = document.getElementById("music-toggle");

    openButton.addEventListener("click", () => {
        cover.style.opacity = "0";
        setTimeout(() => {
            cover.style.display = "none";
        }, 1500); // Sesuaikan dengan durasi transisi CSS

        mainContent.style.display = "block";
        document.body.style.overflow = "auto";
        audio.play().catch((e) => console.error(e));
        musicToggleButton.classList.remove("paused");
    });

    // --- Kontrol Musik ---
    musicToggleButton.addEventListener("click", () => {
        if (audio.paused) {
            audio.play();
            musicToggleButton.classList.remove("paused");
        } else {
            audio.pause();
            musicToggleButton.classList.add("paused");
        }
    });

    // --- Animasi Saat Scroll ---
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                }
            });
        },
        { threshold: 0.1 }
    );
    document
        .querySelectorAll(".animate-on-scroll")
        .forEach((el) => observer.observe(el));

    // --- Hitung Mundur ---
    const countdown = () => {
        const countDate = new Date("December 25, 2025 00:00:00").getTime();
        const now = new Date().getTime();
        const gap = countDate - now;
        const timerContainer = document.getElementById("countdown-timer");

        if (gap > 0) {
            const second = 1000,
                minute = second * 60,
                hour = minute * 60,
                day = hour * 24;
            timerContainer.innerHTML = `
                <div class="time-box"><span id="days">${Math.floor(
                    gap / day
                )}</span><span>Hari</span></div>
                <div class="time-box"><span id="hours">${Math.floor(
                    (gap % day) / hour
                )}</span><span>Jam</span></div>
                <div class="time-box"><span id="minutes">${Math.floor(
                    (gap % hour) / minute
                )}</span><span>Menit</span></div>
                <div class="time-box"><span id="seconds">${Math.floor(
                    (gap % minute) / second
                )}</span><span>Detik</span></div>`;
        } else {
            timerContainer.innerHTML = "<h4>Acara Telah Berlangsung</h4>";
        }
    };
    setInterval(countdown, 1000);

    // --- Modal Galeri ---
    const modal = document.getElementById("gallery-modal");
    const modalImg = document.getElementById("modal-image");
    document.querySelectorAll(".gallery-item").forEach((item) => {
        item.addEventListener("click", () => {
            modal.style.display = "block";
            modalImg.src = item.src;
        });
    });
    document
        .querySelector(".close-modal")
        .addEventListener("click", () => (modal.style.display = "none"));
    window.addEventListener("click", (e) => {
        if (e.target == modal) modal.style.display = "none";
    });

    // --- Salin Rekening ---
    document.querySelectorAll(".copy-button").forEach((button) => {
        button.addEventListener("click", () => {
            navigator.clipboard.writeText(button.dataset.account).then(() => {
                button.innerHTML =
                    '<i class="fa-solid fa-check"></i> Tersalin!';
                setTimeout(() => {
                    button.innerHTML =
                        '<i class="fa-solid fa-copy"></i> Salin Rekening';
                }, 2000);
            });
        });
    });

    // --- Buku Tamu (Guest Book) ---
    const rsvpForm = document.getElementById("rsvp-form");
    const guestbookContainer = document.getElementById("guestbook-container");

    const displayGuestbookEntry = (name, attendance, wishes) => {
        const entryDiv = document.createElement("div");
        entryDiv.className = "guestbook-entry";
        entryDiv.innerHTML = `
            <div class="header">
                <span class="name">${name}</span>
                <span class="attendance"><i class="fa-solid fa-circle-check"></i> ${attendance}</span>
            </div>
            <p class="message">${wishes}</p>`;
        guestbookContainer.prepend(entryDiv); // Tampilkan yang terbaru di atas
    };

    // Contoh ucapan awal
    displayGuestbookEntry(
        "Budi Santoso",
        "Hadir",
        "Selamat berbahagia John & Jane! Semoga menjadi keluarga yang sakinah, mawadah, warahmah."
    );
    displayGuestbookEntry(
        "Citra Lestari",
        "Hadir",
        "Congrats on your wedding! Wishing you a lifetime of love and happiness."
    );

    rsvpForm.addEventListener("submit", function (event) {
        event.preventDefault();
        const name = document.getElementById("name").value;
        const attendance = document.getElementById("attendance").value;
        const wishes = document.getElementById("wishes").value;

        // Tampilkan ucapan baru di buku tamu
        displayGuestbookEntry(name, attendance, wishes);

        // Beri notifikasi
        alert(`Terima kasih ${name} atas konfirmasi dan ucapannya!`);

        // Di sini Anda bisa menambahkan kode untuk mengirim data ke Google Sheets/server.
        this.reset();
    });
});
