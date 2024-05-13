<?php get_header();  
if (have_posts()) : while (have_posts()) : the_post();
?>

<?php if(has_post_format('quote'))  { ?>
    <div class="container">
    <?php get_template_part('/post-types/post-quote-post' );} else {?>  
    
      
<div itemscope itemtype="https://schema.org/NewsArticle">
<meta itemscope itemprop="mainEntityOfPage"  content=""  itemType="https://schema.org/WebPage" itemid="<?php the_permalink(); ?>"/>

<div class="page-header">

    <?php if ( has_post_thumbnail()){
		
		the_post_thumbnail('citygov_header',array('class' => 'standard grayscale grayscale-fade'));
    
    } else { 
    
    	if(empty($themnific_redux['tmnf-header-image']['url'])) {} else { ?>
            
                <img class="page-header-img" src="<?php echo esc_url($themnific_redux['tmnf-header-image']['url']);?>" alt="<?php the_title_attribute(); ?>"/>
                
        <?php } 
        
    } ?>
    
    <div class="container">

    	<div class="main-breadcrumbs">
        
        	<?php citygov_breadcrumbs()?>
            
        </div>

        <h1 class="entry-title"><span itemprop="name"><?php the_title(); ?></span></h1>
    
    </div>
        
</div>


<?php
// Check if the function from the plugin exists
if (function_exists('tmnf_simple_metabox_render')) {
    // Get the current post ID
    $post_id = get_the_ID();

    // Retrieve metabox values
    $text_value = get_post_meta($post_id, '_tmnf_simple_text', true);
    $textarea_value = get_post_meta($post_id, '_tmnf_simple_textarea', true);
    $color_value = get_post_meta($post_id, '_tmnf_simple_color', true);
    $select_value = get_post_meta($post_id, '_tmnf_simple_select', true);
    $radio_value = get_post_meta($post_id, '_tmnf_simple_radio', true);
    ?>

    <div class="metabox-values">
        <h2>Metabox Values</h2>
        <?php if (!empty($text_value)) : ?>
            <p><strong>Text Input:</strong> <?php echo esc_html($text_value); ?></p>
        <?php endif; ?>
        <?php if (!empty($textarea_value)) : ?>
            <p><strong>Textarea:</strong> <?php echo esc_html($textarea_value); ?></p>
        <?php endif; ?>
        <?php if (!empty($color_value)) : ?>
            <p><strong>Color Picker:</strong> <span style="color:<?php echo esc_attr($color_value); ?>"><?php echo esc_html($color_value); ?></span></p>
        <?php endif; ?>
        <?php if (!empty($select_value)) : ?>
            <p><strong>Select:</strong> <?php echo esc_html($select_value); ?></p>
        <?php endif; ?>
        <?php if (!empty($radio_value)) : ?>
            <p><strong>Radio:</strong> <?php echo esc_html($radio_value); ?></p>
        <?php endif; ?>
    </div>


<?php } ?>

<?php
// Retrieve custom fields data
$custom_fields = get_post_meta(get_the_ID(), '_tmnf_simple_custom_fields', true);

// Check if custom fields data exists and it is an array
if (!empty($custom_fields) && is_array($custom_fields)) {
    // Loop through each set of custom fields
    foreach ($custom_fields as $field) {
        // Check if the 'name' and 'number' keys exist in the current field
        if (isset($field['name']) && isset($field['number'])) {
            // Output the custom field values
            echo '<p>Name: ' . esc_html($field['name'][0]) . '</p>';
            echo '<p>Number: ' . esc_html($field['number'][0]) . '</p>';
        }
    }
}
?>




<div id="core" <?php post_class('container_alt'); ?>>
   
    <div class="postbar">
    
    	<div id="content_start" class="tmnf_anchor"></div>

        <div id="content" class="eightcol first">
            
            <?php get_template_part('/single-content' ); ?>
               
        </div><!-- end #content -->
    
        <?php get_sidebar(); ?>
   
    </div><!-- end .postbar -->
    
</div> 

<?php }?>
        
        <?php endwhile; else: ?>
        
            <p><?php esc_html_e('Sorry, no posts matched your criteria','citygov');?>.</p>
        
        <?php endif; ?>

</div><!-- end NewsArticle -->
   
<?php get_footer(); ?>