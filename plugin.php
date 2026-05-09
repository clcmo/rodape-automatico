<?php
/**
 * Plugin Name: Rodapé Automático
 * Description: Adiciona um shortcode para exibir o copyright com o ano atual.
 * Version: 1.0
 * Author: Camila Leite
 * Author URL: https://go.camilaloliveira.com/dev
 * Text Domain: footer-copyright
 */

// Não carregar diretamente, a menos que ative.
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

function custom_copyright_shortcode() {
    $ano_atual = date("Y");
    $texto = "&copy; " . $ano_atual . ". Camila L. Oliveira. Todos os direitos reservados.";
    
    return '<span class="custom-footer-copyright">' . $texto . '</span>';
}

// Registra o shortcode [meu_copyright]
add_shortcode('meu_copyright', 'custom_copyright_shortcode');