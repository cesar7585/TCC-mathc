
<!-- Estilos CSS -->
<style>
/* Resetando estilos básicos */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Corpo da página */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #F9F5FB;
    color: #4B2F6C;
    line-height: 1.4;
    padding: 0;
}

/* Cabeçalho */
header {
    background-color: #6A4C91;
    color: #EDE1F5;
    padding: 15px 0;
    text-align: center;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
}

header h1 {
    font-size: 1.8rem;
}

header a {
    color: #EDE1F5;
    text-decoration: none;
    margin: 0 10px;
    font-weight: 600;
    font-size: 1rem;
}

header a:hover {
    color: #C0A1D9;
    text-decoration: underline;
}

/* Container principal */
.container {
    max-width: 500px; /* Largura do formulário reduzida */
    margin: 40px auto;
    text-align: center;
    background-color: #FFFFFF;
    padding: 25px 20px; /* Reduzido o padding */
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
}

.container h1 {
    color: #6A4C91;
    font-size: 2rem;
    margin-bottom: 20px;
}

.container p {
    font-size: 1rem;
    color: #6A4C91;
    margin-bottom: 25px;
}

.container input[type="email"],
.container input[type="password"] {
    width: 100%;
    padding: 8px;
    margin: 8px 0;
    border: 2px solid #C0A1D9;
    border-radius: 6px;
    background-color: #F2E6FF;
    font-size: 0.9rem;
}

.container input[type="email"]:focus,
.container input[type="password"]:focus {
    border-color: #6A4C91;
    outline: none;
}

.container button {
    width: 100%;
    padding: 10px;
    background-color: #6A4C91;
    color: #EDE1F5;
    font-size: 1rem;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
}

.container button:hover {
    background-color: #C0A1D9;
    transform: translateY(-1px);
}

.container button:active {
    transform: translateY(0);
}

.erro {
    color: red;
    margin-top: 15px;
    font-size: 1rem;
}

/* Rodapé */
footer {
    background-color: #6A4C91;
    color: #EDE1F5;
    text-align: center;
    padding: 15px 0;
    position: relative;
    bottom: 0;
    width: 100%;
    font-size: 0.8rem;
}

footer a {
    color: #EDE1F5;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

footer a:hover {
    color: #C0A1D9;
}

/* Estilos Responsivos */
@media (max-width: 768px) {
    header h1 {
        font-size: 1.5rem;
    }

    .container h1 {
        font-size: 1.8rem;
    }

    .container p {
        font-size: 0.9rem;
    }

    .container input[type="email"],
    .container input[type="password"] {
        padding: 6px;
        font-size: 0.9rem;
    }

    .container button {
        font-size: 0.9rem;
    }
}

</style>
