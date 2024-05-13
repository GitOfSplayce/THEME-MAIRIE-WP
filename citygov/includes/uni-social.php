			<?php $themnific_redux = get_option( 'themnific_redux' ); ?>
            <ul class="social-menu tranz">
            
            <?php if (!empty($themnific_redux['tmnf-social-rss'])) { ?>
            <li class="sprite-rss"><a title="<?php esc_attr_e('Rss Feed','citygov');?>" href="<?php echo esc_url($themnific_redux['tmnf-social-rss']);?>"><i class="fas fa-rss"></i><span><?php esc_html_e('Rss Feed','citygov');?></span></a></li><?php } ?>
            
            <?php if (!empty($themnific_redux['tmnf-social-facebook'])) { ?>
            <li class="sprite-facebook"><a target="_blank" class="mk-social-facebook" title="<?php esc_attr_e('Facebook','citygov');?>" href="<?php echo esc_url($themnific_redux['tmnf-social-facebook']);?>"><i class="fa-brands fa-facebook-f"></i><span><?php esc_html_e('Facebook','citygov');?></span></a></li><?php } ?>
            
            <?php if (!empty($themnific_redux['tmnf-social-twitter'])) { ?>
            <li class="sprite-twitter"><a target="_blank" class="mk-social-twitter-alt" title="<?php esc_attr_e('Twitter','citygov');?>" href="<?php echo esc_url($themnific_redux['tmnf-social-twitter']);?>"><i class="fa-brands fa-twitter"></i><i class="fa-brands fa-x-twitter"></i><span><?php esc_html_e('Twitter','citygov');?></span></a></li><?php } ?>
            
            <?php if (!empty($themnific_redux['tmnf-social-threads'])) { ?>
            <li class="sprite-threads"><a target="_blank" class="mk-social-threads" title="<?php esc_attr_e('Threads','citygov');?>" href="<?php echo esc_url($themnific_redux['tmnf-social-threads']);?>"><i class="fa-brands fa-threads"></i><span><?php esc_html_e('Threads','citygov');?></span></a></li><?php } ?>

            <?php if (!empty($themnific_redux['tmnf-social-flickr'])) { ?>
            <li class="sprite-flickr"><a target="_blank" class="mk-social-flickr" title="<?php esc_attr_e('Flickr','citygov');?>" href="<?php echo esc_url($themnific_redux['tmnf-social-flickr']);?>"><i class="fa-brands fa-flickr"></i><span><?php esc_html_e('Flickr','citygov');?></span></a></li><?php } ?>
            
            <?php if (!empty($themnific_redux['tmnf-social-500'])) { ?>
            <li class="sprite-px"><a target="_blank" class="differ2" title="<?php esc_attr_e('500px','citygov');?>" href="<?php echo esc_url($themnific_redux['tmnf-social-500']);?>"><i class="fa-brands fa-500px"></i><span><?php esc_html_e('500px','citygov');?></span></a></li><?php } ?>
            
            <?php if (!empty($themnific_redux['tmnf-social-instagram'])) { ?>
            <li class="sprite-instagram"><a class="mk-social-photobucket" title="<?php esc_attr_e('Instagram','citygov');?>" href="<?php echo esc_url($themnific_redux['tmnf-social-instagram']);?>"><i class="fa-brands fa-instagram"></i><span><?php esc_html_e('Instagram','citygov');?></span></a></li><?php } ?>
            
            <?php if (!empty($themnific_redux['tmnf-social-pinterest'])) { ?>
            <li class="sprite-pinterest"><a target="_blank" class="mk-social-pinterest" title="<?php esc_attr_e('Pinterest','citygov');?>" href="<?php echo esc_url($themnific_redux['tmnf-social-pinterest']);?>"><i class="fa-brands fa-pinterest"></i><span><?php esc_html_e('Pinterest','citygov');?></span></a></li><?php } ?>
            
            <?php if (!empty($themnific_redux['tmnf-social-youtube'])) { ?>
            <li class="sprite-youtube"><a target="_blank" class="mk-social-youtube" title="<?php esc_attr_e('YouTube','citygov');?>" href="<?php echo esc_url($themnific_redux['tmnf-social-youtube']);?>"><i class="fa-brands fa-youtube"></i><span><?php esc_html_e('YouTube','citygov');?></span></a></li><?php } ?>
            
            <?php if (!empty($themnific_redux['tmnf-social-vimeo'])) { ?>
            <li class="sprite-vimeo"><a target="_blank" class="mk-social-vimeo" title="<?php esc_attr_e('Vimeo','citygov');?>" href="<?php echo esc_url($themnific_redux['tmnf-social-vimeo']);?>"><i class="fa-brands fa-vimeo-square"></i><span><?php esc_html_e('Vimeo','citygov');?></span></a></li><?php } ?>
            
            <?php if (!empty($themnific_redux['tmnf-social-github'])) { ?>
            <li class="sprite-github"><a title="<?php esc_attr_e('GitHub','citygov');?>" href="<?php echo esc_url($themnific_redux['tmnf-social-github']);?>"><i class="fa-brands fa-github"></i><span><?php esc_html_e('GitHub','citygov');?></span></a></li><?php } ?>
            
            <?php if (!empty($themnific_redux['tmnf-social-linkedin'])) { ?>
            <li class="sprite-linkedin"><a target="_blank" class="mk-social-linkedin" title="<?php esc_attr_e('LinkedIn','citygov');?>" href="<?php echo esc_url($themnific_redux['tmnf-social-linkedin']);?>"><i class="fa-brands fa-linkedin-in"></i><span><?php esc_html_e('LinkedIn','citygov');?></span></a></li><?php } ?>
            
            <?php if (!empty($themnific_redux['tmnf-social-skype'])) { ?>
            <li class="sprite-skype"><a target="_blank" class="mk-social-skype" title="<?php esc_attr_e('Skype','citygov');?>" href="<?php echo esc_url($themnific_redux['tmnf-social-skype']);?>"><i class="fa-brands fa-skype"></i><span><?php esc_html_e('Skype','citygov');?></span></a></li><?php } ?>
            
            <?php if (!empty($themnific_redux['tmnf-social-tumblr'])) { ?>
            <li class="sprite-tumblr"><a target="_blank" class="mk-social-tumblr" title="<?php esc_attr_e('Tumblr','citygov');?>" href="<?php echo esc_url($themnific_redux['tmnf-social-tumblr']);?>"><i class="fa-brands fa-tumblr"></i><span><?php esc_html_e('Tumblr','citygov');?></span></a></li><?php } ?>
            
            <?php if (!empty($themnific_redux['tmnf-social-foursquare'])) { ?>
            <li class="sprite-foursquare"><a  title="<?php esc_attr_e('Foursquare','citygov');?>" href="<?php echo esc_url($themnific_redux['tmnf-social-foursquare']);?>"><i class="fa-brands fa-foursquare"></i><span><?php esc_html_e('Foursquare','citygov');?></span></a></li><?php } ?>
            
            <?php if (!empty($themnific_redux['tmnf-social-dribbble'])) { ?>
            <li class="sprite-dribbble"><a target="_blank" class="mk-social-dribbble" title="<?php esc_attr_e('Dribbble','citygov');?>" href="<?php echo esc_url($themnific_redux['tmnf-social-dribbble']);?>"><i class="fa-brands fa-dribbble"></i><span><?php esc_html_e('Dribbble','citygov');?></span></a></li><?php } ?>
            
            <?php if (!empty($themnific_redux['tmnf-social-stumbleupon'])) { ?>
            <li class="sprite-stumbleupon"><a target="_blank" title="<?php esc_attr_e('StumbleUpon','citygov');?>" href="<?php echo esc_url($themnific_redux['tmnf-social-stumbleupon']);?>"><i class="fa-brands fa-stumbleupon"></i><span><?php esc_html_e('StumbleUpon','citygov');?></span></a></li><?php } ?>
            
            <?php if (!empty($themnific_redux['tmnf-social-soundcloud'])) { ?>
            <li><a target="_blank" title="<?php esc_attr_e('SoundCloud','citygov');?>" href="<?php echo esc_url($themnific_redux['tmnf-social-soundcloud']);?>"><i class="fa-brands fa-soundcloud"></i><span><?php esc_html_e('SoundCloud','citygov');?></span></a></li><?php } ?>
            
            <?php if (!empty($themnific_redux['tmnf-social-spotify'])) { ?>
            <li class="sprite-spotify"><a target="_blank" title="<?php esc_attr_e('Spotify','citygov');?>" href="<?php echo esc_url($themnific_redux['tmnf-social-spotify']);?>"><i class="fa-brands fa-spotify"></i><span><?php esc_html_e('Spotify','citygov');?></span></a></li><?php } ?>
            
            <?php if (!empty($themnific_redux['tmnf-social-xing']))  { ?>
            <li class="sprite-xing"><a target="_blank" title="<?php esc_attr_e('Xing','citygov');?>" href="<?php echo esc_url($themnific_redux['tmnf-social-xing']);?>"><i class="fa-brands fa-xing"></i><span><?php esc_html_e('Xing','citygov');?></span></a></li><?php } ?>
            
            <?php if (!empty($themnific_redux['tmnf-social-whatsapp']))  { ?>
            <li class="sprite-whatsapp"><a target="_blank" title="<?php esc_attr_e('WhatsApp','citygov');?>" href="<?php echo esc_url($themnific_redux['tmnf-social-whatsapp']);?>"><i class="fa-brands fa-whatsapp"></i><span><?php esc_html_e('WhatsApp','citygov');?></span></a></li><?php } ?>
            
            <?php if (!empty($themnific_redux['tmnf-social-vk'])) { ?>
            <li class="sprite-vk"><a target="_blank" title="<?php esc_attr_e('VKontakte','citygov');?>" href="<?php echo esc_url($themnific_redux['tmnf-social-vk']);?>"><i class="fa-brands fa-vk"></i><span><?php esc_html_e('VKontakte','citygov');?></span></a></li><?php } ?>
            
            <?php if (!empty($themnific_redux['tmnf-social-snapchat']))  { ?>
            <li class="sprite-snapchat"><a target="_blank" title="<?php esc_attr_e('Snapchat','citygov');?>" href="<?php echo esc_url($themnific_redux['tmnf-social-snapchat']);?>"><i class="fa-brands fa-snapchat-ghost"></i><span><?php esc_html_e('Snapchat','citygov');?></span></a></li><?php } ?>
            
            <?php if (!empty($themnific_redux['tmnf-social-telegram']))  { ?>
            <li class="sprite-telegram"><a target="_blank" title="<?php esc_attr_e('Telegram','citygov');?>" href="<?php echo esc_url($themnific_redux['tmnf-social-telegram']);?>"><i class="fa-brands fa-telegram-plane"></i><span><?php esc_html_e('Telegram','citygov');?></span></a></li><?php } ?>
            
            <?php if (!empty($themnific_redux['tmnf-social-tiktok']))  { ?>
            <li class="sprite-tiktok"><a target="_blank" title="<?php esc_attr_e('TikTok','citygov');?>" href="<?php echo esc_url($themnific_redux['tmnf-social-tiktok']);?>"><i class="fa-brands fa-tiktok"></i><span><?php esc_html_e('TikTok','citygov');?></span></a></li><?php } ?>

            <li class="search-item">
            
            	<a class="searchOpen" href="<?php esc_url('#'); ?>" aria-label="<?php esc_html_e( 'Open Search Window', 'citygov' ); ?>"><i class="fas fa-search"></i><span class="screen-reader-text"><?php echo _x( 'Open Search Window', 'label', 'citygov' ); ?></span></a></li>
            
            </ul>