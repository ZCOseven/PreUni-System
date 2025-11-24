<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=keyboard_arrow_down" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast@1/dist/css/iziToast.min.css">

</head>

<body class="login-body">

    <header class="login-header">
        <img class="login-logo" src="{{ asset('img/logo-v1.svg') }}" alt="Logo del sistema">

        <!-- Selector de idioma -->
        <div class="login-lang">
            <select id="lang-select" class="login-lang_select">
                <option value="es">ESP</option>
                <option value="en">ENG</option>
            </select>

            <!-- Imagen dinámica de la bandera -->
            <img id="lang-flag" class="login-lang_flag" src="{{ asset('img/bandera-españa.svg') }}" alt="Bandera">
        </div>

    </header>

    <main class="login-content">

        <img class="login-illustration" src="{{ asset('img/img-login.svg') }}" alt="Imagen de login">

        <section class="login-form_section">

            <h1 class="login-title" id="text-title"></h1>

            <p class="login-subtitle" id="text-subtitle"></p>

            <form class="login-form" action="{{ route('login.process') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="email" id="label-email"></label>
                    <input type="email" name="email" id="email" required>
                </div>

                <div class="form-group">
                    <label for="password" id="label-password"></label>
                    <input type="password" name="password" id="password" required>
                </div>

                <div class="form-check">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember" id="label-remember"></label>
                </div>

                <button class="btn-primary" type="submit" id="btn-login"></button>
            </form>

        </section>

    </main>

    <style>
        .toast-custom-pos {
            bottom: 30px !important;
            right: 30px !important;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/izitoast@1/dist/js/iziToast.min.js"></script>

    @if ($errors->any())
    <script>
        iziToast.error({
            title: 'Error',
            message: 'Credenciales incorrectas o usuario inactivo',
            position: 'bottomRight',
            class: 'toast-custom-pos'
        });
    </script>
    @endif

    <!-- Script de traducción -->
    <script>
        const translations = {
            es: {
                title: "Iniciar sesión",
                subtitle: "<span>¡Bienvenido de nuevo!</span> Por favor, inicia sesión en tu cuenta.",
                email: "Tu correo electrónico:",
                password: "Tu contraseña:",
                remember: "Mantener sesión iniciada",
                button: "Ingresar"
            },
            en: {
                title: "Sign in",
                subtitle: "<span>Welcome back!</span> Please sign in to your account.",
                email: "Your email:",
                password: "Your password:",
                remember: "Keep me signed in",
                button: "Login"
            }
        };

        const langSelect = document.getElementById("lang-select");
        const flagImg = document.getElementById("lang-flag");

        // --- Cargar idioma guardado ---
        let currentLang = localStorage.getItem("lang") || "es";
        langSelect.value = currentLang;

        // --- Cargar bandera inicial ---
        function updateFlag() {
            if (currentLang === "es") {
                flagImg.src = "{{ asset('img/bandera-españa.svg') }}";
            } else {
                flagImg.src = "{{ asset('img/bandera-usa.svg') }}";
            }
        }

        // --- Actualizar textos de la interfaz ---
        function updateTexts() {
            const t = translations[currentLang];

            document.getElementById("text-title").textContent = t.title;
            document.getElementById("text-subtitle").innerHTML = t.subtitle;
            document.getElementById("label-email").textContent = t.email;
            document.getElementById("label-password").textContent = t.password;
            document.getElementById("label-remember").textContent = t.remember;
            document.getElementById("btn-login").textContent = t.button;
        }

        // --- Inicializar ---
        updateTexts();
        updateFlag();

        // --- Cambiar idioma ---
        langSelect.addEventListener("change", () => {
            currentLang = langSelect.value;
            localStorage.setItem("lang", currentLang);
            updateTexts();
            updateFlag();
        });
    </script>

</body>

</html>