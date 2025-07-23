<!DOCTYPE html>
<html lang="en" class="text-[12px] lg:text-[16px]">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Tailwind CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <!-- Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <!-- Animate on Scroll Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <style type="text/tailwindcss">
        @theme {
            --color-accent: #004a2f;
            --color-accent-light: #007048;
            --color-secondary: #888888;
        }

        @layer base {
            body {
                font-family: "Poppins", sans-serif;
            }
        }

        @layer utilities {
            h1 {
                font-size: 2rem;
                font-weight: bold;
                color: var(--color-accent);
            }

            p {
                color: var(--color-secondary);
            }

            .bg-custom-gradient {
                background-image: linear-gradient(to top, #def3ea, #ffffff);
            }

            .button-accent {
                width: fit-content;
                border-radius: 0.5rem;
                display: block;
                padding: 0.8rem 2rem;
                color: white;
                background-color: var(--color-accent);
                font-weight: 500;
            }

            .button-accent:hover {
                background-color: var(--color-accent-light);
            }

            .blob-mask {
                mask-image: url("/assets/blob-shape.svg");
                -webkit-mask-image: url("/assets/blob-shape.svg");
                mask-size: cover;
                -webkit-mask-size: cover;
                mask-repeat: no-repeat;
                -webkit-mask-repeat: no-repeat;
                mask-position: center;
                -webkit-mask-position: center;
            }

            .gradient-ball-yellow {
                @apply w-96 h-96 rounded-full;
                background: radial-gradient(circle,
                        rgba(255, 247, 205, 0.8) 0%,
                        rgba(255, 255, 255, 0) 60%);
            }

            .gradient-ball-purple {
                @apply w-96 h-96 rounded-full;
                background: radial-gradient(circle,
                        rgba(255, 223, 250, 0.8) 0%,
                        rgba(255, 255, 255, 0) 60%);
            }
        }
    </style>
    <title>WeClic - Slicing Task</title>
</head>

<body class="">
    @include('components.navbar')

    @yield('content')

    <script>
        AOS.init({
            offset: 50,
            once: true
        });

        function animateCounterElement(counter) {
            const end = parseInt(counter.getAttribute("data-target"), 10);
            const duration =
                parseInt(counter.getAttribute("data-duration"), 10) || 2000;
            const start = 0;
            const range = end - start;
            const startTime = performance.now();

            function update(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const value = Math.floor(progress * range);
                counter.textContent = value.toLocaleString();

                if (progress < 1) {
                    requestAnimationFrame(update);
                } else {
                    counter.textContent = end.toLocaleString();
                }
            }

            requestAnimationFrame(update);
        }

        function setupScrollTriggeredCounters() {
            const counters = document.querySelectorAll(".counter");

            const observer = new IntersectionObserver(
                (entries, observer) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            animateCounterElement(entry.target);
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.5,
                }
            );

            counters.forEach((counter) => observer.observe(counter));
        }

        document.addEventListener(
            "DOMContentLoaded",
            setupScrollTriggeredCounters
        );
    </script>
</body>

</html>
