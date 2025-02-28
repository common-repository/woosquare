<?php
/**
 * Manage WC Shop Sync Addons
 *
 * This file handles the management of addons for WC Shop Sync.
 *
 * @package Woosquare_Plus
 */

?>

<style>
	.blog-posts.hfeed {
		display: flex;
		-webkit-flex-wrap: wrap;
		-ms-flex-wrap: wrap;
	}

	.post-outer {
		float: left;
		width: 33.33%;
		padding: 0px 15px;
		box-sizing: border-box;
	}

	.post-outer .prtn-article {
		background: #fff;
		padding-right: 0px;
		border-radius: 5px;
		box-shadow: 23px 24px 56px 0 rgba(17, 16, 16, 0.05);
		-webkit-transition: all .6s cubic-bezier(.165, .84, .44, 1);
		-moz-transition: all .6s cubic-bezier(.165, .84, .44, 1);
		-o-transition: all .6s cubic-bezier(.165, .84, .44, 1);
		transition: all .6s cubic-bezier(.165, .84, .44, 1);
	}

	.prtn-article {
		margin-bottom: 30px;
		border-radius: 0px;
		position: relative;
	}

	article {
		padding: 0 10px 0 0;
	}

	.prtn-article .prtn-article-image {
		position: relative;
		display: inline-block;
		width: 100%;
	}

	.prtn-article .prtn-bgr {
		bottom: 0;
		left: 0;
		opacity: 0.7;
		position: absolute;
		right: 0;
		top: 0;
		-webkit-transition: 0.4s;
		-o-transition: 0.4s;
		transition: 0.4s;
	}

	a {
		text-decoration: none;
		color: #000;
	}

	.prtn-article .prtn-article-image .prtn-featured-wid {
		width: 100%;
		height: 200px;
		display: block;
		background-size: cover !important;
		background-position: center center !important;
	}

	.prtn-article .share-links {
		opacity: 0;
		left: 0;
		margin-top: -15px;
		position: absolute;
		right: 0;
		top: 50%;
		-webkit-transition: 0.4s;
		-o-transition: 0.4s;
		transition: 0.4s;
		display: inline;
		text-align: center;
	}

	.clearfix {
		clear: both;
	}

	.prtn-article .post-cat {
		position: absolute;
		top: 5px;
		left: 5px;
		font-size: 14px;
		font-weight: 400;
		display: block;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
		width: 100%;
	}

	.prtn-article .article-content {
		box-sizing: border-box;
		padding: 10px 20px;
	}

	.prtn-featured-wid {
		border-radius: 10px 10px 0px 0px;
		box-shadow: 10px 3px 25px 0 rgba(17, 16, 16, 0.05);
	}

	.prtn-article a.btn-read {
		background: #141a1b;
		border: 1px solid #141a1b;
		display: inline-block;
		right: 20px;
		padding: 4px 18px 3px;
		margin-top: 20px;
		margin-bottom: 10px;
		font-size: 11.5px;
		color: #FFF;
		text-transform: uppercase;
	}

	.welcome-panel h3 {
		margin: 0.1em 0 0;
		font-size: 16px;
	}

	.prtn-article a.btn-read:hover {
		background: #222525;
		color: white;
		border: 1px solid #141a1b;
	}

	a.btn-read.ryt-btn {
		left: 180px;
		position: relative;
	}

	/*video popup css*/
	.modal-dialog {
		max-width: 800px;
		margin: 30px auto;
	}

	.modal-body {
		position: relative;
		padding: 0px;
	}

	.close {
		position: absolute;
		right: -30px;
		top: 0;
		z-index: 999;
		font-size: 2rem;
		font-weight: normal;
		color: #fff;
		opacity: 1;
	}

	/*video popup css end*/
</style>
<div class="bodycontainerWrapModule">
	<div class="titleBlock">
		<h1 class="mtitle">Manage WC Shop Sync Addons</h1>
		<p>From here you can Enable/Disable addons as per your requirement.</p>
	</div>
	<?php
		$data = isset( $_SERVER['QUERY_STRING'] ) ? sanitize_text_field( wp_unslash( $_SERVER['QUERY_STRING'] ) ) : '';
		parse_str( $data, $query_params );
	?>
		
	<div class="welcome-panel moduleListing<?php echo isset( $query_params['page'] ) ? esc_html( sanitize_text_field( wp_unslash( $query_params['page'] ) ) ) : ''; ?>">
		<div id="main" class="main section">

		<div class="blog-posts hfeed">

			<?php
			if ( $plugin_modules ) {
				foreach ( $plugin_modules as $key => $module ) {

					?>
			<div class="post-outer">
				<style>
					#blog-pager {
					padding: 10px 0px;
					padding-bottom: 14px;
					}

					.displaypageNum a,
					.showpage a,
					.pagecurrent {
					background: transparent;
					color: #282828;
					border: 0px;
					font-size: 14px;
					}

					.pagecurrent {
					margin-top: 0px;
					display: inline;
					}
				</style>
				<article class="hentry prtn-article">
					<div class="prtn-article-image">
									<?php if ( $module['module_activate'] ) { ?>
					<div class="settingsWrap">

										<?php if ( ! empty( $module['module_menu_details']['menu_slug'] ) && 'square-modifiers' !== $module['module_menu_details']['menu_slug'] ) : ?>
						<a target="_blank"
							href="<?php echo esc_url( get_admin_url() . 'admin.php?page=' . $module['module_menu_details']['menu_slug'] ); ?>">
							<span class="dashicons dashicons-admin-generic"></span>Setting
						</a>
						<?php endif; ?>
					</div>
					<?php }  if ( ! $module['is_premium'] ) { ?>

						<div class="switchWrap">
							<div class="extonoffpp onoffswitch_<?php echo esc_html( $key ); ?>">
								<input type="checkbox" name="onoffswitch_<?php echo esc_html( $key ); ?>"
									class="onoffswitch-checkbox_<?php echo esc_html( $key ); ?> enable_plugin" id="myonoffswitch_<?php echo esc_html( $key ); ?>"
										<?php
										if ( false === ! $module['module_activate'] ) {
											echo 'checked'; }
										?>
										>
								<label
									class="
										<?php
										if ( $module['module_activate'] ) {
											echo 'extonofflabel '; }
										?>
									onoffswitch-label_<?php echo esc_html( $key ); ?>"
									for="myonoffswitch_<?php echo esc_html( $key ); ?>">
									<span class="extonoff onoffswitch-inner_<?php echo esc_html( $key ); ?>"></span>
									<span class="extonoffouter onoffswitch-switch_<?php echo esc_html( $key ); ?>"></span>
								</label>
							</div>
						</div> 
					<?php } else { ?>
						<div class="switchWrap">
							<div class="extonoffpp onoffswitch_<?php echo esc_html( $key ); ?>">
							   
								<label
									class="onoffswitch-label_"
									for="myonoffswitch_">
									<span class="extonoff onoffswitch-inner_"><a target="_blank" class="btn get-plus-btn waves-effect waves-light btn-rounded btn-primary" href="<?php echo esc_url( 'https://apiexperts.io/solutions/woosquare-plus/?utm_source=plugin&utm_medium=addons&utm_campaign=' . $module['module_slug'] ); ?>">Upgrade to Plus</a></span>
								  
								</label>
							</div>
						</div> 
					<?php } ?>
					 
					<div class="prtn-post-image">

						<div class="prtn-bgr"></div>
						<a target="_blank" href="<?php echo esc_url( $module['module_redirect'] ); ?>">
							<div class="prtn-featured-wid" style="background:url(<?php echo esc_url( $module['module_img'] ); ?>)"></div>
						</a>

					</div>
					</div>
					<div class="article-content">

					<div class="entry-header clearfix">
						<h3 class="entry-title"><a class="modules_title" target="_blank" href="<?php echo esc_url( $module['module_redirect'] ); ?>"
								title="The aquatic life's are intresting">
								<?php
								echo esc_html( $module['module_title'] );
								?>
								</a>
						</h3>
					</div>


					<div class="entry-content">
						<div><?php echo esc_html( $module['module_short_excerpt'] ); ?></div>
					</div>


					<div class="actionblock">
						<a target="_blank" class="btn btnIncus waves-effect waves-light btn-rounded btn-primary"
							href="<?php echo esc_url( $module['module_redirect'] ); ?>"><span class="hidemobile">Read More</span> <span
								class="dashicons dashicons-media-text mobiletext"></span></a>
										<?php if ( ! empty( $module['module_video'] ) ) { ?>

						<a href="<?php echo esc_url( $module['module_video'] ); ?>"
							class="btn btnIncus waves-effect waves-light btn-rounded btn-outline-primary videoBtn"
							data-toggle="modal" data-target="#myModal">
							<span class="hidemobile">Demo Video</span><span
								class="dashicons dashicons-video-alt3 mobiletext"></span>
						</a>
					</div>

					<?php } ?>
					<style>
						.onoffswitch_<?php echo esc_html( $key ); ?> {
							/* position: relative;  */
							/* width: 91px; */
							-webkit-user-select: none;
							-moz-user-select: none;
							-ms-user-select: none;
						}

						.onoffswitch-checkbox_<?php echo esc_html( $key ); ?> {
							display: none;
						}

						.onoffswitch-label_<?php echo esc_html( $key ); ?> {
							display: block;
							overflow: hidden;
							cursor: pointer;
							border: 2px solid #858585;
							border-radius: 250px;
							width: 40px
						}

						.onoffswitch-inner_<?php echo esc_html( $key ); ?> {
							display: block;
							width: 200%;
							margin-left: -100%;
							transition: margin 0.3s ease-in 0s;
						}

						.onoffswitch-inner_<?php echo esc_html( $key ); ?>:before,
						.onoffswitch-inner_<?php echo esc_html( $key ); ?>:after {
							display: block;
							float: left;
							width: 50%;
							height: 16px;
							padding: 0;
							line-height: 16px;
							font-size: 14px;
							color: white;
							font-family: Trebuchet, Arial, sans-serif;
							font-weight: bold;
							box-sizing: border-box;
						}

						.onoffswitch-inner_<?php echo esc_html( $key ); ?>:before {
							content: " ";
							padding-left: 10px;
							background-color: #FFFFFF;
							color: #7A7070;
						}

						.onoffswitch-inner_<?php echo esc_html( $key ); ?>:after {
							content: " ";
							padding-right: 10px;
							background-color: #dbdbdb;
							color: #FFFFFF;
							text-align: right;
						}

						.onoffswitch-switch_<?php echo esc_html( $key ); ?> {
							/* display: block; 
					width: 26px; 
					height: 26px;  */
							/* margin: 0px; */
							/* background: #FFFFFF; */
							/* position: absolute; 
					top: 0; 
					bottom: 0; */
							/* right: 59px; */
							/* background: #0071ee; */
							/* box-shadow: 0px 0px 10px -5px #a1bad6; */
							/* border-radius: 250px;
					transition: all 0.3s ease-in 0s; */

						}

						.onoffswitch-checkbox_<?php echo esc_html( $key ); ?>:checked+.onoffswitch-label_<?php echo esc_html( $key ); ?>.onoffswitch-inner_<?php echo esc_html( $key ); ?> {
							margin-left: 0;
						}

						.onoffswitch-checkbox_<?php echo esc_html( $key ); ?>:checked+.onoffswitch-label_<?php echo esc_html( $key ); ?>.onoffswitch-switch_<?php echo esc_html( $key ); ?> {
							/* right: 0px;  */
						}

						input#myonoffswitch_<?php echo esc_html( $key ); ?> {
							display: none;
						}

						a.btn-read.video-btn {
							background: #23a8e1;
							color: #FFF;
							border-color: #23a8e1;
						}
					</style>

									<?php
										/*
										<a class="btn-read ryt-btn" href=""><?php if(!$module['module_activate']){ echo 'Activate'; } else { echo 'Deactivate'; } ?></a>
										*/
									?>
					</div>
				</article>
			</div>
							<?php
				}
			}
			?>
		</div>
		</div>
	</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">


		<div class="modal-body">

			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<!-- 16:9 aspect ratio -->
			<div class="embed-responsive embed-responsive-16by9">
				<iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always"
					allow="autoplay"></iframe>
			</div>

		</div>

		</div>
	</div>
</div>
 
<script>
	jQuery(document).ready(function () {
		// Gets the video src from the data-src on each button
		var videoSrc;
		console.log(videoSrc);
		jQuery('.videoBtn').click(function () {
		videoSrc = jQuery(this).attr("href");
		console.log(videoSrc);
		});


		// when the modal is opened autoplay it  
		jQuery('#myModal').on('shown.bs.modal', function (e) {

		// set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
		jQuery("#video").attr('src', videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
		})

		// stop playing the youtube video when I close the modal
		jQuery('#myModal').on('hide.bs.modal', function (e) {
		// a poor man's stop video
		jQuery("#video").attr('src', videoSrc);
		console.log(videoSrc);
		})
		// document ready  
	});

</script>
