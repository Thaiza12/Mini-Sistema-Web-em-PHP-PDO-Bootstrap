/*
 * assets/js/script.js
 * ------------------------------------------------------------------
 * JavaScript personalizado do projeto.
 *
 * Função principal: pedir confirmação antes de excluir um registro,
 * evitando que o usuário apague algo por engano.
 * ------------------------------------------------------------------
 */

// Espera a página carregar completamente
document.addEventListener('DOMContentLoaded', function () {

    // Seleciona todos os botões que têm a classe "btn-excluir"
    const botoesExcluir = document.querySelectorAll('.btn-excluir');

    // Para cada botão de excluir, adiciona uma confirmação
    botoesExcluir.forEach(function (botao) {
        botao.addEventListener('click', function (evento) {
            // Se o usuário cancelar, impede a navegação (não exclui)
            const confirmar = confirm('Tem certeza que deseja excluir este registro?');
            if (!confirmar) {
                evento.preventDefault();
            }
        });
    });

});
