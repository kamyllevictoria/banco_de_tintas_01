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
// Animação da tela Login/Cadastro

var btnSignin = document.querySelector("#signin");
var btnSignup = document.querySelector("#signup");

var body = document.querySelector("body");

btnSignin.addEventListener("click", function(){
    body.className = "sign-in-js";
});

btnSignup.addEventListener("click", function(){
    body.className = "sign-up-js";
});

btnSignup.addEventListener("click", function(){
    body.className = "sign-up-js"
})

const btnCadastrar = document.querySelector("#signin");

//Gambiarra ------------------------------------------------
btnCadastrar.addEventListener('click', () => {
    // Esconde o botão
    btnCadastrar.classList.add('oculto');

    // Espera 3 segundos (3000ms) e mostra de novo
    setTimeout(() => {
        btnCadastrar.classList.remove('oculto');
    }, 3500);
});

const btnEntrar= document.querySelector("#signup");

    btnEntrar.addEventListener('click', () => {
    // Esconde o botão
    btnEntrar.classList.add('oculto');

    // Espera 3 segundos (3000ms) e mostra de novo
    setTimeout(() => {
        btnEntrar.classList.remove('oculto');
    }, 3500);
});
//------------------------------------------------------------
function cpfOuCnpj() {
    const pessoaFisica = document.querySelector('input[name="tipoPessoa"][value="fisica"]').checked;
    const campoCPF = document.getElementById("campoCPF");
    const campoCNPJ = document.getElementById("campoCNPJ");
    const nomeEmpresa = document.getElementById("nomeEmpresa");

    if (pessoaFisica) {
        campoCPF.style.display = "block";
        campoCNPJ.style.display = "none";
        nomeEmpresa.style.display = "none";
    } else {
        campoCPF.style.display = "none";
        campoCNPJ.style.display = "block";
        nomeEmpresa.style.display = "block";
    }
}

document.getElementById('Telefone').addEventListener('input', function (e) {
    let input = e.target;
    let value = input.value.replace(/\D/g, '');

    if (value.length > 11) value = value.slice(0, 11);

    let telFormatted = '';

    if (value.length > 0) {
        telFormatted += '(' + value.substring(0, 2); // DDD
    }
    if (value.length >= 3) {
        telFormatted += ') ' + value.substring(2, 7); // Começo do número
    }
    if (value.length >= 8) {
        telFormatted += '-' + value.substring(7, 11); // Final do número
    }

    input.value = telFormatted;
});
document.getElementById('CPF').addEventListener('input', function (e) {
    let input = e.target;
    let value = input.value.replace(/\D/g, ''); // Remove tudo que não for número

    if (value.length > 11) value = value.slice(0, 11); // Limita a 11 dígitos

    let cpfFormatted = '';

    if (value.length > 0) {
        cpfFormatted += value.substring(0, 3);
    }
    if (value.length >= 4) {
        cpfFormatted += '.' + value.substring(3, 6);
    }
    if (value.length >= 7) {
        cpfFormatted += '.' + value.substring(6, 9);
    }
    if (value.length >= 10) {
        cpfFormatted += '-' + value.substring(9, 11);
    }

    input.value = cpfFormatted;
});
document.getElementById('CNPJ').addEventListener('input', function (e) {
    let input = e.target;
    let value = input.value.replace(/\D/g, ''); // Remove tudo que não for número

    if (value.length > 14) value = value.slice(0, 14); // Limita a 14 dígitos

    let cnpjFormatted = '';

    if (value.length > 0) {
        cnpjFormatted += value.substring(0, 2);
    }
    if (value.length >= 3) {
        cnpjFormatted += '.' + value.substring(2, 5);
    }
    if (value.length >= 6) {
        cnpjFormatted += '.' + value.substring(5, 8);
    }
    if (value.length >= 9) {
        cnpjFormatted += '/' + value.substring(8, 12);
    }
    if (value.length >= 13) {
        cnpjFormatted += '-' + value.substring(12, 14);
    }

    input.value = cnpjFormatted;
});

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