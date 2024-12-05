function toggleMenu() {
    const menu = document.getElementById('sideMenu');
    const overlay = document.getElementById('menuOverlay');
    const isOpen = menu.classList.contains('open');

    if (isOpen) {
        menu.classList.remove('open');
        overlay.classList.remove('active');
    } else {
        menu.classList.add('open');
        overlay.classList.add('active');
    }
}
function cpfOuCnpj() {
    const pessoaFisica = document.querySelector('input[name="tipoPessoa"][value="fisica"]').checked;
    const campoCPF = document.getElementById("campoCPF");
    const campoCNPJ = document.getElementById("campoCNPJ");
    const nomeEmpresa = document.getElementById("nomeEmpresa");
    const nomePessoa = document.getElementById("nomePessoa");

    if (pessoaFisica) {
        campoCPF.style.display = "block";
        nomePessoa.style.display = "block"
        campoCNPJ.style.display = "none";
        nomeEmpresa.style.display = "none";
    } else {
        campoCPF.style.display = "none";
        nomePessoa.style.display = "none"
        campoCNPJ.style.display = "block";
        nomeEmpresa.style.display = "block";
    }
}

function atualizarBotao(opcao) {
    document.getElementById('dropdownMenuButton').innerText = opcao;
}
document.querySelectorAll('.accordion-button').forEach(button => {
    button.addEventListener('click', function() {
        const target = document.querySelector(button.getAttribute('data-bs-target'));
        
        // Se a seção já está aberta, feche-a
        if (target.classList.contains('show')) {
            target.classList.remove('show');
        } else {
            // Caso contrário, deixe o Bootstrap lidar com o fechamento de outras seções
            target.classList.add('show');
        }
    });
});
// Função para ativar/desativar o alto contraste
document.addEventListener('DOMContentLoaded', () => {
    const toggleHighContrast = document.getElementById('toggleHighContrast');

    // Carregar o estado inicial do modo de alto contraste
    if (localStorage.getItem('highContrast') === 'enabled') {
        document.body.classList.add('high-contrast');
        toggleHighContrast.checked = true;
    }

    toggleHighContrast.addEventListener('change', (event) => {
        if (event.target.checked) {
            document.body.classList.add('high-contrast');
            localStorage.setItem('highContrast', 'enabled');
        } else {
            document.body.classList.remove('high-contrast');
            localStorage.setItem('highContrast', 'disabled');
        }
    });
});