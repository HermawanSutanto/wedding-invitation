document.addEventListener("DOMContentLoaded", () => {
    // --- DATA ---
    const futureDate = new Date();
    futureDate.setMonth(futureDate.getMonth() + 2);
    futureDate.setDate(15);
    futureDate.setHours(9, 0, 0, 0);

    const invitationData = {
        groom: {
            name: "Ahmad",
            info: "Putra dari Bpk. Yusuf & Ibu. Maryam",
            photoUrl: "https://picsum.photos/400/400?random=1",
        },
        bride: {
            name: "Fatimah",
            info: "Putri dari Bpk. Ibrahim & Ibu. Hajar",
            photoUrl: "https://picsum.photos/400/400?random=2",
        },
        quote: "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang.",
        quoteSource: "QS. Ar-Rum: 21",
        events: [
            {
                title: "Akad Nikah",
                eventDate: futureDate.toISOString(),
                startTime: "09:00",
                venueName: "Masjid Agung Al-Azhar",
                venueAddress:
                    "Jl. Sisingamangaraja, Selong, Kebayoran Baru, Jakarta Selatan",
                googleMapsLink: "https://maps.app.goo.gl/abcdef123456",
            },
            {
                title: "Resepsi",
                eventDate: futureDate.toISOString(),
                startTime: "19:00",
                venueName: "Balai Kartini",
                venueAddress:
                    "Jl. Gatot Subroto Kav. 37, Kuningan, Jakarta Selatan",
                googleMapsLink: "https://maps.app.goo.gl/fedcba654321",
            },
        ],
        stories: [
            {
                title: "Pertama Bertemu",
                storyDate: "Juni 2022",
                description:
                    "Kami bertemu di sebuah acara komunitas, di mana senyum pertama menjadi awal dari cerita indah yang tak terlupakan.",
                order: 1,
            },
            {
                title: "Momen Spesial",
                storyDate: "Maret 2023",
                description:
                    "Sebuah perjalanan ke puncak gunung menjadi saksi bisu, saat kami menyadari bahwa kami ingin menua bersama.",
                order: 2,
            },
            {
                title: "Lamaran",
                storyDate: "Desember 2024",
                description:
                    "Di bawah langit senja yang mempesona, sebuah cincin menjadi simbol janji suci untuk selamanya.",
                order: 3,
            },
        ],
        galleries: [
            {
                id: 1,
                imageUrl: "https://picsum.photos/800/600?random=11",
                alt: "Gallery image 1",
            },
            {
                id: 2,
                imageUrl: "https://picsum.photos/600/800?random=12",
                alt: "Gallery image 2",
            },
            {
                id: 3,
                imageUrl: "https://picsum.photos/800/600?random=13",
                alt: "Gallery image 3",
            },
            {
                id: 4,
                imageUrl: "https://picsum.photos/800/600?random=14",
                alt: "Gallery image 4",
            },
            {
                id: 5,
                imageUrl: "https://picsum.photos/600/800?random=15",
                alt: "Gallery image 5",
            },
            {
                id: 6,
                imageUrl: "https://picsum.photos/800/600?random=16",
                alt: "Gallery image 6",
            },
        ],
        gifts: [
            {
                bankName: "Bank Syariah Indonesia (BSI)",
                accountNumber: "1234567890",
                accountHolderName: "Ahmad & Fatimah",
            },
            {
                bankName: "Bank Central Asia (BCA)",
                accountNumber: "0987654321",
                accountHolderName: "Ahmad",
            },
        ],
        guestbooks: [
            {
                id: 1,
                name: "Budi Santoso",
                attendanceStatus: "Hadir",
                message:
                    "Selamat ya Ahmad & Fatimah! Semoga menjadi keluarga yang sakinah, mawaddah, warahmah. Aamiin.",
                createdAt: new Date(
                    Date.now() - 2 * 24 * 60 * 60 * 1000
                ).toISOString(),
            },
            {
                id: 2,
                name: "Citra Lestari",
                attendanceStatus: "Hadir",
                message:
                    "Barakallah! Turut berbahagia untuk kalian berdua. Lancar sampai hari H.",
                createdAt: new Date(
                    Date.now() - 1 * 24 * 60 * 60 * 1000
                ).toISOString(),
            },
        ],
        heroImageUrl: "https://picsum.photos/1200/800?random=98",
        coverImageUrl: "https://picsum.photos/1080/1920?random=99",
    };

    let guestbookEntries = [...invitationData.guestbooks];
    const guestName =
        new URLSearchParams(window.location.search).get("to") ||
        "Tamu Undangan";

    // --- DOM ELEMENTS ---
    const cover = document.getElementById("opening-cover");
    const mainContent = document.getElementById("main-content");
    const audio = document.getElementById("background-music");
    const musicBtn = document.getElementById("music-player-btn");
    const guestbookContainer = document.getElementById("guestbook-entries");

    // --- HELPER FUNCTIONS ---
    const timeAgo = (date) => {
        const seconds = Math.floor((new Date() - new Date(date)) / 1000);
        let interval = seconds / 31536000;
        if (interval > 1) return Math.floor(interval) + " tahun lalu";
        interval = seconds / 2592000;
        if (interval > 1) return Math.floor(interval) + " bulan lalu";
        interval = seconds / 86400;
        if (interval > 1) return Math.floor(interval) + " hari lalu";
        interval = seconds / 3600;
        if (interval > 1) return Math.floor(interval) + " jam lalu";
        interval = seconds / 60;
        if (interval > 1) return Math.floor(interval) + " menit lalu";
        return "Baru saja";
    };

    // --- UI POPULATION ---
    function populateUI() {
        const coupleNames = `${invitationData.groom.name} & ${invitationData.bride.name}`;

        // Cover & Hero
        document.getElementById("cover-couple-names").textContent = coupleNames;
        document.querySelector(
            ".cover-background"
        ).style.backgroundImage = `url(${invitationData.coverImageUrl})`;
        document
            .querySelectorAll(".cover-guest-name, .hero-guest-name")
            .forEach((el) => (el.textContent = guestName));
        document.getElementById(
            "hero"
        ).style.backgroundImage = `url(${invitationData.heroImageUrl})`;
        document.getElementById("hero-couple-names").textContent = coupleNames;
        const eventDate = new Date(invitationData.events[0].eventDate);
        document.getElementById("hero-date").textContent =
            eventDate.toLocaleDateString("id-ID", {
                weekday: "long",
                year: "numeric",
                month: "long",
                day: "numeric",
            });

        // Quote
        document.getElementById(
            "quote-text"
        ).textContent = `"${invitationData.quote}"`;
        document.getElementById(
            "quote-source"
        ).textContent = `- ${invitationData.quoteSource} -`;

        // Couple
        const groomContainer = document.getElementById("groom-details");
        groomContainer.innerHTML = `<img src="${invitationData.groom.photoUrl}" alt="${invitationData.groom.name}">
                                    <h3>${invitationData.groom.name}</h3><p>${invitationData.groom.info}</p>`;
        const brideContainer = document.getElementById("bride-details");
        brideContainer.innerHTML = `<img src="${invitationData.bride.photoUrl}" alt="${invitationData.bride.name}">
                                    <h3>${invitationData.bride.name}</h3><p>${invitationData.bride.info}</p>`;

        // Story
        const storyContainer = document.getElementById("story-timeline");
        storyContainer.innerHTML = invitationData.stories
            .sort((a, b) => a.order - b.order)
            .map(
                (story) => `
            <div class="story-item">
                <div class="story-item-content">
                    <p class="story-date">${story.storyDate}</p>
                    <h3 class="story-title">${story.title}</h3>
                    <p>${story.description}</p>
                </div>
            </div>
        `
            )
            .join("");

        // Events
        const eventContainer = document.getElementById("event-cards");
        eventContainer.innerHTML = invitationData.events
            .map(
                (event) => `
            <div class="card">
                <h3>${event.title}</h3>
                <p>${new Date(event.eventDate).toLocaleDateString("id-ID", {
                    weekday: "long",
                    day: "numeric",
                    month: "long",
                    year: "numeric",
                })}</p>
                <p>${event.startTime} WIB</p>
                <div class="card-divider"></div>
                <p><strong>${event.venueName}</strong></p>
                <p>${event.venueAddress}</p>
                ${
                    event.googleMapsLink
                        ? `<a href="${event.googleMapsLink}" target="_blank" rel="noopener">Lihat Peta</a>`
                        : ""
                }
            </div>
        `
            )
            .join("");

        // Gallery
        const galleryContainer = document.getElementById("gallery-grid");
        galleryContainer.innerHTML = invitationData.galleries
            .map(
                (item) => `
            <div class="gallery-item" data-src="${item.imageUrl}">
                <img src="${item.imageUrl}" alt="${item.alt}">
            </div>
        `
            )
            .join("");

        // Gifts
        const giftContainer = document.getElementById("gift-cards");
        giftContainer.innerHTML = invitationData.gifts
            .map(
                (gift) => `
            <div class="card gift-card">
                <h3>${gift.bankName}</h3>
                <p>a.n. ${gift.accountHolderName}</p>
                <p class="account-number">${gift.accountNumber}</p>
                <button class="copy-btn" data-account="${gift.accountNumber}">Salin No. Rek</button>
            </div>
        `
            )
            .join("");

        // Footer
        document.getElementById("footer-couple-names").textContent =
            coupleNames;
        document.getElementById("current-year").textContent =
            new Date().getFullYear();

        renderGuestbook();
    }

    function renderGuestbook() {
        if (guestbookEntries.length === 0) {
            guestbookContainer.innerHTML =
                '<p class="text-center">Jadilah yang pertama memberikan ucapan!</p>';
            return;
        }
        guestbookContainer.innerHTML = guestbookEntries
            .sort(
                (a, b) =>
                    new Date(b.createdAt).getTime() -
                    new Date(a.createdAt).getTime()
            )
            .map(
                (entry) => `
            <div class="guestbook-entry">
                <div class="guestbook-header">
                    <p class="guestbook-name">${entry.name}</p>
                    <span class="attendance-status ${
                        entry.attendanceStatus === "Hadir"
                            ? "hadir"
                            : "tidak-hadir"
                    }">${entry.attendanceStatus}</span>
                </div>
                <p class="guestbook-message">"${entry.message}"</p>
                <p class="guestbook-timestamp">${timeAgo(entry.createdAt)}</p>
            </div>
        `
            )
            .join("");
    }

    // --- EVENT LISTENERS & FUNCTIONALITY ---

    // Open Invitation
    document
        .getElementById("open-invitation-btn")
        .addEventListener("click", () => {
            cover.classList.add("fade-out");
            mainContent.classList.remove("hidden");
            musicBtn.classList.remove("hidden");
            audio.play().catch((e) => console.error("Audio play failed:", e));
            updateMusicButton(true);
            window.scrollTo({ top: 0, behavior: "smooth" });
        });

    // Music Player
    const musicIcons = {
        play: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>`,
        pause: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>`,
    };
    const updateMusicButton = (isPlaying) => {
        musicBtn.innerHTML = isPlaying ? musicIcons.pause : musicIcons.play;
        musicBtn.setAttribute(
            "aria-label",
            isPlaying ? "Pause music" : "Play music"
        );
    };
    musicBtn.addEventListener("click", () => {
        if (audio.paused) {
            audio.play();
            updateMusicButton(true);
        } else {
            audio.pause();
            updateMusicButton(false);
        }
    });

    // Countdown Timer
    const countdownContainer = document.getElementById("countdown");
    const targetDate = new Date(invitationData.events[0].eventDate).getTime();
    const countdownInterval = setInterval(() => {
        const now = new Date().getTime();
        const distance = targetDate - now;
        if (distance < 0) {
            clearInterval(countdownInterval);
            countdownContainer.innerHTML = "<p>Acara telah berlangsung</p>";
            return;
        }
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor(
            (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
        );
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        countdownContainer.innerHTML = `
            <div class="countdown-item"><span class="countdown-value">${String(
                days
            ).padStart(
                2,
                "0"
            )}</span><span class="countdown-label">Hari</span></div>
            <div class="countdown-item"><span class="countdown-value">${String(
                hours
            ).padStart(
                2,
                "0"
            )}</span><span class="countdown-label">Jam</span></div>
            <div class="countdown-item"><span class="countdown-value">${String(
                minutes
            ).padStart(
                2,
                "0"
            )}</span><span class="countdown-label">Menit</span></div>
            <div class="countdown-item"><span class="countdown-value">${String(
                seconds
            ).padStart(
                2,
                "0"
            )}</span><span class="countdown-label">Detik</span></div>
        `;
    }, 1000);

    // Scroll Animations
    const sections = document.querySelectorAll(".section");
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("is-visible");
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.1 }
    );
    sections.forEach((section) => observer.observe(section));

    // Gallery Modal
    const modal = document.getElementById("gallery-modal");
    const modalImg = document.getElementById("modal-image");
    document.getElementById("gallery-grid").addEventListener("click", (e) => {
        const item = e.target.closest(".gallery-item");
        if (item) {
            modal.style.display = "flex";
            modalImg.src = item.dataset.src;
            document.body.style.overflow = "hidden";
        }
    });
    document
        .querySelector(".gallery-modal-close")
        .addEventListener("click", () => {
            modal.style.display = "none";
            document.body.style.overflow = "auto";
        });
    modal.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.style.display = "none";
            document.body.style.overflow = "auto";
        }
    });

    // Copy to Clipboard
    document.getElementById("gift-cards").addEventListener("click", (e) => {
        const btn = e.target.closest(".copy-btn");
        if (btn) {
            navigator.clipboard.writeText(btn.dataset.account);
            btn.textContent = "Tersalin!";
            setTimeout(() => {
                btn.textContent = "Salin No. Rek";
            }, 2000);
        }
    });

    // RSVP Form
    const rsvpForm = document.getElementById("rsvp-form");
    const formStatus = document.getElementById("form-status");
    rsvpForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const formData = new FormData(rsvpForm);
        const newEntry = {
            id: guestbookEntries.length + 1,
            name: formData.get("name"),
            attendanceStatus: formData.get("attendance_status"),
            message: formData.get("message"),
            createdAt: new Date().toISOString(),
        };
        guestbookEntries.push(newEntry);
        renderGuestbook();
        rsvpForm.reset();
        formStatus.textContent =
            "Terima kasih! Konfirmasi Anda telah terkirim.";
        formStatus.className = "form-status success";
        setTimeout(() => {
            formStatus.textContent = "";
        }, 5000);
    });

    // --- INITIALIZATION ---
    populateUI();
    updateMusicButton(false);
});
