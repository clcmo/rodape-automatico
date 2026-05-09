<?php
/**
 * Plugin Name: Rodapé Automático
 * Description: Adiciona um shortcode para exibir o copyright com o ano atual.
 * Version: 1.1
 * Author: Camila Leite
 * Author URL: https://go.camilaloliveira.com/dev
 * Text Domain: footer-copyright
 */

// Não carregar diretamente, a menos que ative.
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

function custom_copyright_shortcode() {
    // Captura o ano atual do servidor
    $ano_atual = date("Y");

    // Captura o nome do site definido no painel do WordPress
    $nome_do_site = get_bloginfo('name');

    // Monta a estrutura com variáveis
    $texto = "&copy; " . $ano_atual . ". " . $nome_do_site . ". Todos os direitos reservados.";
    
    return '<span class="custom-footer-copyright">' . $texto . '</span>';
}

// Registra o shortcode [meu_copyright]
add_shortcode('meu_copyright', 'custom_copyright_shortcode');