<?php
/**
 * Admin: Page branding
 *
 * @package SimplePay
 * @subpackage Core
 * @copyright Copyright (c) 2022, Sandhills Development, LLC
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 4.4.0
 *
 * @var string $title Promotional title.
 * @var array<string, array<string, string>> $links Promotional links.
 */

?>

<div class="simpay-footer-promotion">
	<p><?php echo esc_html( $title ); ?></p>

	<ul class="simpay-footer-promotion-links">
		<?php foreach ( $links as $key => $item ) : ?>
			<li>
				<?php
				printf(
					'<a href="%1s" target="_blank" ref="noopener noreferrer">%2$s</a>%3$s',
					esc_url( $item['url'] ),
					esc_html( $item['text'] ),
					count( $links ) === (int) $key + 1 ? '' : '<span>/</span>'
				);
				?>
			</li>
		<?php endforeach; ?>
	</ul>
	<ul class="simpay-footer-promotion-social">
		<li>
			<a href="https://www.facebook.com/wpsimplepay" target="_blank" rel="noopener noreferrer">
				<svg width="16" height="16" aria-hidden="true">
					<path fill="#A7AAAD" d="M16 8.05A8.02 8.02 0 0 0 8 0C3.58 0 0 3.6 0 8.05A8 8 0 0 0 6.74 16v-5.61H4.71V8.05h2.03V6.3c0-2.02 1.2-3.15 3-3.15.9 0 1.8.16 1.8.16v1.98h-1c-1 0-1.31.62-1.31 1.27v1.49h2.22l-.35 2.34H9.23V16A8.02 8.02 0 0 0 16 8.05Z"/>
				</svg>
				<span class="screen-reader-text">
					<?php echo esc_html_e( 'Facebook', 'simple-pay' ); ?>
				</span>
			</a>
		</li>
		<li>
			<a href="https://twitter.com/wpsimplepay" target="_blank" rel="noopener noreferrer">
				<svg width="17" height="16" aria-hidden="true">
					<path fill="#A7AAAD" d="M15.27 4.43A7.4 7.4 0 0 0 17 2.63c-.6.27-1.3.47-2 .53a3.41 3.41 0 0 0 1.53-1.93c-.66.4-1.43.7-2.2.87a3.5 3.5 0 0 0-5.96 3.2 10.14 10.14 0 0 1-7.2-3.67C.86 2.13.7 2.73.7 3.4c0 1.2.6 2.26 1.56 2.89a3.68 3.68 0 0 1-1.6-.43v.03c0 1.7 1.2 3.1 2.8 3.43-.27.06-.6.13-.9.13a3.7 3.7 0 0 1-.66-.07 3.48 3.48 0 0 0 3.26 2.43A7.05 7.05 0 0 1 0 13.24a9.73 9.73 0 0 0 5.36 1.57c6.42 0 9.91-5.3 9.91-9.92v-.46Z"/>
				</svg>
				<span class="screen-reader-text">
					<?php echo esc_html_e( 'Twitter', 'simple-pay' ); ?>
				</span>
			</a>
		</li>
	</ul>
</div>
