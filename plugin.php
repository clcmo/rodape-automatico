<?php
/**
 * Plugin Name: Rodapé Automático
 * Plugin URI:  http://wordpress.org/plugins/rodape-automatico/
 * Description: Adiciona um shortcode para exibir o copyright com o ano atual, personalizado conforme o tipo de site (educativo, sem fins lucrativos, Creative Commons ou geral).
 * Version:     2.0.0
 * Author:      Camila Leite
 * Author URI:  https://go.camilaloliveira.com/dev
 * Text Domain: rodape-automatico
 * License:     GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// Não carregar diretamente, a menos que o WordPress ative.
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

// ─────────────────────────────────────────────
// 1. PÁGINA DE CONFIGURAÇÕES NO PAINEL ADMIN
// ─────────────────────────────────────────────

function ra_register_settings() {
	register_setting( 'ra_settings_group', 'ra_site_type',        array( 'sanitize_callback' => 'sanitize_text_field', 'default' => 'general' ) );
	register_setting( 'ra_settings_group', 'ra_custom_text',      array( 'sanitize_callback' => 'sanitize_text_field', 'default' => '' ) );
	register_setting( 'ra_settings_group', 'ra_cc_license',       array( 'sanitize_callback' => 'sanitize_text_field', 'default' => 'by' ) );
	register_setting( 'ra_settings_group', 'ra_cc_version',       array( 'sanitize_callback' => 'sanitize_text_field', 'default' => '4.0' ) );
	register_setting( 'ra_settings_group', 'ra_show_cc_badge',    array( 'sanitize_callback' => 'absint',             'default' => 1 ) );
}
add_action( 'admin_init', 'ra_register_settings' );

function ra_add_admin_menu() {
	add_options_page(
		__( 'Rodapé Copyright', 'rodape-automatico' ),
		__( 'Rodapé Copyright', 'rodape-automatico' ),
		'manage_options',
		'rodape-automatico',
		'ra_settings_page'
	);
}
add_action( 'admin_menu', 'ra_add_admin_menu' );

function ra_settings_page() {
	$site_type     = get_option( 'ra_site_type', 'general' );
	$custom_text   = get_option( 'ra_custom_text', '' );
	$cc_license    = get_option( 'ra_cc_license', 'by' );
	$cc_version    = get_option( 'ra_cc_version', '4.0' );
	$show_cc_badge = get_option( 'ra_show_cc_badge', 1 );
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Rodapé Copyright – Configurações', 'rodape-automatico' ); ?></h1>

		<form method="post" action="options.php">
			<?php settings_fields( 'ra_settings_group' ); ?>
			<?php do_settings_sections( 'ra_settings_group' ); ?>

			<table class="form-table" role="presentation">

				<!-- TIPO DE SITE -->
				<tr>
					<th scope="row">
						<label for="ra_site_type"><?php esc_html_e( 'Tipo de site', 'rodape-automatico' ); ?></label>
					</th>
					<td>
						<select name="ra_site_type" id="ra_site_type" onchange="raToggleFields(this.value)">
							<option value="general"     <?php selected( $site_type, 'general' ); ?>><?php esc_html_e( 'Geral (Todos os direitos reservados)', 'rodape-automatico' ); ?></option>
							<option value="educational" <?php selected( $site_type, 'educational' ); ?>><?php esc_html_e( 'Site Educativo', 'rodape-automatico' ); ?></option>
							<option value="nonprofit"   <?php selected( $site_type, 'nonprofit' ); ?>><?php esc_html_e( 'Sem Finalidades Lucrativas', 'rodape-automatico' ); ?></option>
							<option value="cc"          <?php selected( $site_type, 'cc' ); ?>><?php esc_html_e( 'Creative Commons', 'rodape-automatico' ); ?></option>
						</select>
						<p class="description"><?php esc_html_e( 'Escolha o tipo que melhor descreve seu site. Isso personaliza o texto exibido pelo shortcode [meu_copyright].', 'rodape-automatico' ); ?></p>
					</td>
				</tr>

				<!-- TEXTO PERSONALIZADO (aparece para educativo e nonprofit) -->
				<tr id="ra_row_custom_text" style="<?php echo in_array( $site_type, array( 'educational', 'nonprofit' ) ) ? '' : 'display:none'; ?>">
					<th scope="row">
						<label for="ra_custom_text"><?php esc_html_e( 'Texto adicional (opcional)', 'rodape-automatico' ); ?></label>
					</th>
					<td>
						<input type="text" name="ra_custom_text" id="ra_custom_text" value="<?php echo esc_attr( $custom_text ); ?>" class="regular-text" />
						<p class="description"><?php esc_html_e( 'Texto extra que aparece após o aviso principal (ex.: nome da instituição, número de registro, etc.).', 'rodape-automatico' ); ?></p>
					</td>
				</tr>

				<!-- LICENÇA CREATIVE COMMONS -->
				<tr id="ra_row_cc" style="<?php echo $site_type === 'cc' ? '' : 'display:none'; ?>">
					<th scope="row">
						<label for="ra_cc_license"><?php esc_html_e( 'Licença Creative Commons', 'rodape-automatico' ); ?></label>
					</th>
					<td>
						<select name="ra_cc_license" id="ra_cc_license">
							<option value="by"         <?php selected( $cc_license, 'by' ); ?>>CC BY – Atribuição</option>
							<option value="by-sa"      <?php selected( $cc_license, 'by-sa' ); ?>>CC BY-SA – Atribuição-CompartilhaIgual</option>
							<option value="by-nd"      <?php selected( $cc_license, 'by-nd' ); ?>>CC BY-ND – Atribuição-SemDerivações</option>
							<option value="by-nc"      <?php selected( $cc_license, 'by-nc' ); ?>>CC BY-NC – Atribuição-NãoComercial</option>
							<option value="by-nc-sa"   <?php selected( $cc_license, 'by-nc-sa' ); ?>>CC BY-NC-SA – Atribuição-NãoComercial-CompartilhaIgual</option>
							<option value="by-nc-nd"   <?php selected( $cc_license, 'by-nc-nd' ); ?>>CC BY-NC-ND – Atribuição-NãoComercial-SemDerivações</option>
						</select>
					</td>
				</tr>

				<tr id="ra_row_cc_version" style="<?php echo $site_type === 'cc' ? '' : 'display:none'; ?>">
					<th scope="row">
						<label for="ra_cc_version"><?php esc_html_e( 'Versão da licença CC', 'rodape-automatico' ); ?></label>
					</th>
					<td>
						<select name="ra_cc_version" id="ra_cc_version">
							<option value="4.0" <?php selected( $cc_version, '4.0' ); ?>>4.0 (recomendada)</option>
							<option value="3.0" <?php selected( $cc_version, '3.0' ); ?>>3.0</option>
							<option value="2.5" <?php selected( $cc_version, '2.5' ); ?>>2.5</option>
						</select>
					</td>
				</tr>

				<tr id="ra_row_cc_badge" style="<?php echo $site_type === 'cc' ? '' : 'display:none'; ?>">
					<th scope="row">
						<?php esc_html_e( 'Exibir ícone CC', 'rodape-automatico' ); ?>
					</th>
					<td>
						<label>
							<input type="checkbox" name="ra_show_cc_badge" value="1" <?php checked( $show_cc_badge, 1 ); ?> />
							<?php esc_html_e( 'Mostrar ícone/link da licença Creative Commons', 'rodape-automatico' ); ?>
						</label>
					</td>
				</tr>

			</table>

			<?php submit_button( __( 'Salvar configurações', 'rodape-automatico' ) ); ?>
		</form>

		<hr>
		<h2><?php esc_html_e( 'Pré-visualização', 'rodape-automatico' ); ?></h2>
		<p><?php echo do_shortcode( '[meu_copyright]' ); ?></p>
		<p class="description"><?php esc_html_e( 'Use o shortcode [meu_copyright] em qualquer página, post, widget ou template.', 'rodape-automatico' ); ?></p>
	</div>

	<script>
	function raToggleFields(type) {
		var rowCustom   = document.getElementById('ra_row_custom_text');
		var rowCc       = document.getElementById('ra_row_cc');
		var rowCcVer    = document.getElementById('ra_row_cc_version');
		var rowCcBadge  = document.getElementById('ra_row_cc_badge');

		rowCustom.style.display  = (type === 'educational' || type === 'nonprofit') ? '' : 'none';
		rowCc.style.display      = (type === 'cc') ? '' : 'none';
		rowCcVer.style.display   = (type === 'cc') ? '' : 'none';
		rowCcBadge.style.display = (type === 'cc') ? '' : 'none';
	}
	</script>
	<?php
}

// ─────────────────────────────────────────────
// 2. SHORTCODE [meu_copyright]
// ─────────────────────────────────────────────

function ra_copyright_shortcode() {
	$ano        = date( 'Y' );
	$site_name  = get_bloginfo( 'name' );
	$site_url   = get_bloginfo( 'url' );
	$site_type  = get_option( 'ra_site_type', 'general' );
	$extra      = sanitize_text_field( get_option( 'ra_custom_text', '' ) );
	$cc_license = get_option( 'ra_cc_license', 'by' );
	$cc_version = get_option( 'ra_cc_version', '4.0' );
	$show_badge = (bool) get_option( 'ra_show_cc_badge', 1 );

	$output = '';

	switch ( $site_type ) {

		case 'educational':
			$output  = '&copy; ' . esc_html( $ano ) . '. ';
			$output .= '<a href="' . esc_url( $site_url ) . '">' . esc_html( $site_name ) . '</a>. ';
			$output .= esc_html__( 'Conteúdo de caráter exclusivamente educativo. Todos os direitos reservados.', 'rodape-automatico' );
			if ( $extra ) {
				$output .= ' ' . esc_html( $extra );
			}
			break;

		case 'nonprofit':
			$output  = '&copy; ' . esc_html( $ano ) . '. ';
			$output .= '<a href="' . esc_url( $site_url ) . '">' . esc_html( $site_name ) . '</a>. ';
			$output .= esc_html__( 'Este site não possui finalidades lucrativas. Todos os direitos reservados.', 'rodape-automatico' );
			if ( $extra ) {
				$output .= ' ' . esc_html( $extra );
			}
			break;

		case 'cc':
			// Monta URL da licença CC
			$cc_url   = 'https://creativecommons.org/licenses/' . esc_attr( $cc_license ) . '/' . esc_attr( $cc_version ) . '/deed.pt_BR';
			$cc_label = strtoupper( $cc_license );

			$output  = esc_html( $site_name ) . ' &mdash; ';
			$output .= esc_html__( 'Licenciado sob', 'rodape-automatico' ) . ' ';
			$output .= '<a href="' . esc_url( $cc_url ) . '" target="_blank" rel="license noopener">Creative Commons ' . esc_html( $cc_label ) . ' ' . esc_html( $cc_version ) . '</a>.';

			if ( $show_badge ) {
				$badge_src = 'https://i.creativecommons.org/l/' . esc_attr( $cc_license ) . '/' . esc_attr( $cc_version ) . '/88x31.png';
				$output   .= ' <a href="' . esc_url( $cc_url ) . '" target="_blank" rel="license noopener">';
				$output   .= '<img src="' . esc_url( $badge_src ) . '" alt="Licença Creative Commons ' . esc_attr( $cc_label ) . '" style="vertical-align:middle;margin-left:6px;" /></a>';
			}
			break;

		default: // 'general'
			$output  = '&copy; ' . esc_html( $ano ) . '. ';
			$output .= '<a href="' . esc_url( $site_url ) . '">' . esc_html( $site_name ) . '</a>. ';
			$output .= esc_html__( 'Todos os direitos reservados.', 'rodape-automatico' );
			break;
	}

	return '<span class="ra-rodape-automatico">' . $output . '</span>';
}
add_shortcode( 'meu_copyright', 'ra_copyright_shortcode' );

// ─────────────────────────────────────────────
// 3. CSS INLINE MÍNIMO
// ─────────────────────────────────────────────

function ra_enqueue_styles() {
	$custom_css = '.ra-rodape-automatico { font-size: 0.875em; }
	               .ra-rodape-automatico a { color: inherit; text-decoration: underline; }';
	wp_register_style( 'ra-style', false );
	wp_enqueue_style( 'ra-style' );
	wp_add_inline_style( 'ra-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'ra_enqueue_styles' );