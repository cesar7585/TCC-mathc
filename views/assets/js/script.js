// Seleção de elementos
const menuToggle = document.getElementById('menu-toggle');
const navbar = document.getElementById('navbar');
const backToTopBtn = document.getElementById('back-to-top');
const themeToggle = document.getElementById('theme-toggle');

// Função para abrir/fechar o menu de navegação
menuToggle.addEventListener('click', () => {
    navbar.classList.toggle('open');
});

// Função para mostrar o botão de "Voltar ao Topo"
window.addEventListener('scroll', () => {
    if (window.scrollY > 200) {
        backToTopBtn.style.display = 'block';
    } else {
        backToTopBtn.style.display = 'none';
    }
});

// Função para voltar ao topo ao clicar no botão
backToTopBtn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

// Função para alternar entre tema claro e escuro
themeToggle.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme');
    if (document.body.classList.contains('dark-theme')) {
        themeToggle.innerText = 'Alternar para Tema Claro';
    } else {
        themeToggle.innerText = 'Alternar para Tema Escuro';
    }
});

// Adiciona animação de scroll suave ao clicar em links de navegação
const links = document.querySelectorAll('nav a');
links.forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        const targetId = link.getAttribute('href').replace('#', '');
        const targetElement = document.getElementById(targetId);
        targetElement.scrollIntoView({ behavior: 'smooth' });
        navbar.classList.remove('open'); // Fecha o menu em telas pequenas
    });
});