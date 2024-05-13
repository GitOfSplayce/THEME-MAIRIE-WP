<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>
<form role="search" class="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr($unique_id); ?>">
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'citygov' ); ?></span>
	</label>
<input id="<?php echo esc_attr($unique_id); ?>"  type="text" name="s" class="s p-border" size="30" value="<?php esc_attr_e('I am looking for...','citygov'); ?>" onfocus="if (this.value = '') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php esc_attr_e('I am looking for...','citygov'); ?>';}" />
<button class='searchSubmit ribbon' ><?php esc_attr_e('Search','citygov'); ?></button>
</form>