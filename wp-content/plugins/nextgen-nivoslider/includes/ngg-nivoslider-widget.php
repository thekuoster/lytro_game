<?php

Class NGG_NivoSlider_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
				'classname' => 'ngg-nivoslider',
				'description' => 'Allows you to pick a gallery from the \'NextGen Gallery\' plugin to use as a Nivo Slider.' );

		parent::WP_Widget( 'nextgen-nivoslider', 'NextGEN NivoSlider', $widget_ops );
	}

	public function widget( $args, $instance ) {
		// Enqueue scripts if being loaded as Widget
		if( is_active_widget( false, false, $this->id_base) ) {
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'jquery-nivo-slider' );
			wp_enqueue_script( 'jquery-shuffle' );
		}

		global $wpdb;
		extract( $args );

		// Plugin Settings
		$s = array(
				'title' => apply_filters( 'widget_title', (isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : "") ),
				'htmlID' => $this->get_val( $instance, 'html_id', 'slider' ),
				'width' => $this->get_val_numeric( $instance, 'width' ),
				'height' => $this->get_val_numeric( $instance, 'height' ),
				'resizeWidth' => $this->get_val_numeric( $instance, 'resizewidth' ),
				'resizeHeight' => $this->get_val_numeric( $instance, 'resizeheight' ),
				'resizeBGColor' => $this->get_val( $instance, 'resizebg' ),
				'resize' => $this->get_val( $instance, 'resize' ),
				'order' => $this->get_val( $instance, 'order', 'asc', false ),
				'tags' => $this->get_val( $instance, 'tags' ),
				'shuffle' => $this->get_val( $instance, 'shuffle' ),
				'limit' => $this->get_val_numeric( $instance, 'max_pictures' ),
				'center' => $this->get_val( $instance, 'center' ),
				'gallery' => $this->get_val_numeric( $instance, 'gallery' ),
				'shortCode' => $this->get_val( $instance, 'shortcode' ),
				'caption' => $this->get_val( $instance, 'caption' ),
				'htmlCaption' => $this->get_val( $instance, 'htmlcaption', '' ),
				'theme' => get_option( 'ngg_nivoslider_theme', 'default' ),
				'thumbsWidth' => $this->get_val_numeric( $instance, 'thumbswidth' ),
				'thumbsHeight' => $this->get_val_numeric( $instance, 'thumbsheight' ),
				'thumbsContainerHeight' => $this->get_val_numeric( $instance, 'thumbscontainerheight' ),
				'thumbsGap' => $this->get_val_numeric( $instance, 'thumbsgap' ) );

		// Nivo Slider Settings
		$ns = array(
				'effect' => $this->get_val( $instance, 'effect' ),
				'slices' => $this->get_val( $instance, 'slices' ),
				'boxCols' => $this->get_val( $instance, 'boxcols' ),
				'boxRows' => $this->get_val( $instance, 'boxrows' ),
				'animSpeed' => $this->get_val( $instance, 'animspeed' ),
				'pauseTime' => $this->get_val( $instance, 'pausetime' ),
				'startSlide' => $this->get_val( $instance, 'startslide' ),
				'directionNav' => $this->get_val( $instance, 'directionnav' ),
				'controlNav' => $this->get_val( $instance, 'controlnav' ),
				'controlNavThumbs' => $this->get_val( $instance, 'controlnavthumbs' ),
				'pauseOnHover' => $this->get_val( $instance, 'pauseonhover' ),
				'keyboardNav' => $this->get_val( $instance, 'keyboardnav' ),
				'manualAdvance' => $this->get_val( $instance, 'manualadvance' ),
				'prevText' => $this->get_val( $instance, 'prevtext' ),
				'nextText' => $this->get_val( $instance, 'nexttext' ),
				'randomStart' => $this->get_val( $instance, "randomstart" ),
				'captionOpacity' => $this->get_val( $instance, 'captionopacity' ),
				'beforeChange' => $this->get_val( $instance, 'beforechange', '', false ),
				'afterChange' => $this->get_val( $instance, 'afterchange', '', false ),
				'slideshowEnd' => $this->get_val( $instance, 'slideshowend', '', false ),
				'lastSlide' => $this->get_val( $instance, 'lastslide', '', false ),
				'afterLoad' => $this->get_val( $instance, 'afterload', '', false ) );

		// Declare some variables for readability
		$width = $s['width'];
		$height = $s['height'];
		$htmlID = $s['htmlID'];

		// SQL defaults
		$sqlOrder = '';
		$sqlWhere = ' WHERE exclude = 0';
		$sqlLimit = '';

		// Set SQL order
		switch ( $s['order'] ) {
			case 'random':
				$sqlOrder = 'RAND()';
				break;
			case 'sortorder':
				$sqlOrder = 'sortorder ASC';
				break;
			case 'desc':
				$sqlOrder = 'galleryid DESC';
				break;
			case 'asc':
			default:
				$sqlOrder = 'galleryid ASC';
		}

		if ( $s['gallery'] != '' ) {
			$sqlWhere .= ' AND galleryid = ' . $s['gallery'];
		}

		// Set limit defaults only if tags are not being used
		$numLimit = -1;
		if ( is_numeric( $s['limit'] ) ) {
			$numLimit = (int) $s['limit'];
			if ( $s['tags'] == '' ) {
				$sqlLimit = ' LIMIT 0, ' . $s['limit'];
			}
		}

		$results = $wpdb
				->get_results(
						"SELECT * FROM $wpdb->nggpictures" . $sqlWhere . " ORDER BY " . $sqlOrder . $sqlLimit );
		$pSize = 0;
		if ( is_array( $results ) ) {
			// Filter by tag if entered
			if ( $s['tags'] != '' ) {
				$taggedImages = nggTags::find_images_for_tags( $s['tags'] );

				if ( $taggedImages ) {
					$taggedImageIDs = array();
					foreach ( $taggedImages as $image ) {
						$taggedImageIDs[ ] = $image->pid;
					}

					if ( sizeof( $taggedImageIDs ) > 0 ) {

						$filteredResults = array();
						$taggedCount = 0;
						foreach ( $results as $result ) {
							if ( $numLimit != -1 && $taggedCount >= $numLimit ) {
								break;
							} else {
								if ( in_array( $result->pid, $taggedImageIDs ) ) {
									$filteredResults[ ] = $result;
									$taggedCount += 1;
								}
							}
						}

						$results = $filteredResults;
					}

				} else {
					$results = array();
				}
			}

			$pSize = count( $results );
		}

		$output = '';
		if ( $pSize > 0 ) {
			if ( $s['title'] != '' ) {
				if ( $s['shortCode'] != '1' ) {
					$output .= "\n" . $before_title . $s['title'] . $after_title;
				} else {
					$output .= "\n<h3>" . $s['title'] . "</h3>";
				}
			}

			$hasControlNav = ( $ns['controlNav'] == '' || $ns['controlNav'] == 'true' );
			$hasThumbs = ( $ns['controlNavThumbs'] );
			$hasCenter = ( $s['center'] == '1' && $width != '' );

			if ( $width != '' || $height != '' ) {
				$width_css = '';
				$height_css = '';

				if ( $width != '' ) {
					$width_css = "width: " . $width . "px !important;";
				}

				if ( $height != '' ) {
					$height_css = "height: " . $height . "px !important;";
				}
				$output .= "\n<style type=\"text/css\">";

				if ( $width_css != '' || $height_css != '' ) {
					$output .= "\n  ." . $htmlID . "-wrapper { " . $width_css . $height_css . " }";
				}
				$output .= "\n</style>";
			}

			$containerClass = '';
			if ( $hasCenter ) {
				$containerClass = ' nivoSlider-center';
			}
			if ( $hasControlNav ) {
				if ( $hasThumbs ) {
					$containerClass .= ' nivoSlider-controlNavImages';
				} else {
					$containerClass .= ' nivoSlider-controlNavText';
				}
			}

			// Add theme class
			$output .= "\n<div class=\"" . $htmlID . "-wrapper " . $containerClass . " theme-" . $s['theme'] . "\">";
			//$output .= "\n<div class=\"" . $htmlID . "-wrapper theme-" . $s['theme'] . "\">";
			$output .= "\n  <div id=\"" . $htmlID . "\" class=\"nivoSlider\">";
			$imageAltText = null;
			$imageDescription = null;

			foreach ( $results as $result ) {
				$gallery = $wpdb
						->get_row( "SELECT * FROM $wpdb->nggallery WHERE gid = '" . $result->galleryid . "'" );
				foreach ( $gallery as $key => $value ) {
					$result->$key = $value;
				}

				$image = new nggImage( $result );
				$imageAltText = trim( $image->alttext );
				$imageDescription = trim( $image->description );

				$output .= "\n    ";

				// Check if alt is URL
				$use_url = false;

				if ( $imageAltText != ''
						&& preg_match( '%\A/|\Ahttp://|\Aftp://|\Amailto:%', $imageAltText ) ) {
					$use_url = true;
					$output .= "<a href=\"" . esc_attr( $imageAltText ) . "\" target=\"_blank\">";
				} elseif ( $imageDescription != ''
						&& preg_match( '%\A/|\Ahttp://|\Aftp://|\Amailto:%', $imageDescription ) ) {
					$use_url = true;
					$output .= "<a href=\"" . esc_attr( $imageDescription ) . "\" target=\"_blank\">";
				}

				// Add a caption containing the image alttext and/or description
				$imageTitle = '';

				if ( $s['caption'] != '' ) {
					if ( $s['caption'] == 'both' ) {
						if ( $imageAltText <> '' || $imageDescription <> '' ) {
							$imageTitle = ' title="';
							if ( $imageAltText <> '' ) {
								$imageTitle .= $imageAltText;
								if ( $imageDescription <> '') {
									$imageTitle .= ' - ';
								}
							}
							$imageTitle .= $imageDescription . '"';
						}
					} elseif ( $s['caption'] == 'alttext' ) {
						$imageTitle = ' title="' . $imageAltText . '"';
					} elseif ( $s['caption'] == 'description' ) {
						$imageTitle = ' title="' . $imageDescription . '"';
					} elseif ( $s['caption'] == 'html' ) {
						$imageTitle = ' title="#htmlcaption"';
					}
				}

				$output .= '<img src="';

				// Resizing functions here
				// TimThumb takes option 0-3
				if ( $s['resize'] != '0' && (($s['resize'] >= 1) && ($s['resize'] <= 4)) ) {
					$output .= plugins_url( 'includes/timthumb.php', dirname( __FILE__ ) ) . '?zc=' . ($s['resize'] - 1)
							. '&cc=' . $s['resizeBGColor'] . '&src=' . $image->path . '/' . $image->filename;
					if ( $s['resizeHeight'] != '' || $s['resizeWidth'] != '' ) {
						if ( $s['resizeHeight'] ) {
							$output .= '&h=' . $s['resizeHeight'];
						}
						if ( $s['resizeWidth'] ) {
							$output .= '&w=' . $s['resizeWidth'];
						}

					} else {
						if ( $height ) {
							$output .= '&h=' . $height;
						}
						if ( $width ) {
							$output .= '&w=' . $width;
						}
					}

				} else {
					$output .= $image->imageURL;
				}

				$output .= '"' . $imageTitle;

				// Add data-thumb attribute for thumbnail navigation as per NivoSlider v3.0+
				if ( $hasThumbs ) {
					$output .= ' data-thumb="' . $image->thumbURL . '"/>';
				} else {
					$output .= "/>";
				}

				if ( $use_url != '' ) {
					$output .= "</a>";
				}
			}
			$output .= "\n  </div>";
			$output .= "\n</div>";
			if ( $s['htmlCaption'] ) {
				$output .= "\n<div id=\"htmlcaption\" class=\"nivo-html-caption\">" . html_entity_decode($s['htmlCaption']) . "</div>";
			}
		}

		// Nivo arguments
		$javascriptArgs = array();

		// Modifications if only 1 picture
		if ( $pSize <= 1 ) {
			$s['startSlide'] = '0';
			$s['directionNav'] = 'false';
			$s['controlNav'] = 'false';
			$s['keyboardNav'] = 'false';
			$s['pauseOnHover'] = 'false';
			$s['manualAdvance'] = 'false';
			$s['beforeChange'] = '';
			$s['afterChange'] = '';
			$s['slideshowEnd'] = '';
			$s['lastSlide'] = '';
			$s['afterLoad'] = '';
		}

		// Load NivoSettings as Javascript arguments
		foreach ( $ns as $key => $value ) {
			if ($value != '') {
				if ( is_numeric($value) || is_bool($value) || $value == 'false' || $value == 'true' ) {
					$javascriptArgs[ ] = $key . ": " . $value;
				} else {
					$javascriptArgs[ ] = $key . ": '" . $value . "'";
				}
			}
		}

		// Add javascript
		$output .= "\n<script type=\"text/javascript\">";
		$output .= "\n  jQuery(window).load(function() {";

		// Shuffle results locally so even if page is cached the order will be different each time
		if ( $s['order'] == 'random' && $s['shuffle'] == 'true' ) {
			$output .= "\n    jQuery('div#" . $htmlID . "').jj_ngg_shuffle();";
		}
/*
		// XXX Touch support
		$output .= "
		if(jQuery.support.touch){
			jQuery('a.nivo-nextNav').css('visibility', 'hidden !important');
			jQuery('a.nivo-prevNav').css('visibility', 'hidden !important');

			jQuery('div#" . $htmlID . "').bind( 'swipeleft', function( e ) {
				jQuery('a.nivo-nextNav').trigger('click');
				e.stopImmediatePropagation();
				return false; } );

			jQuery('div#" . $htmlID . "').bind( 'swiperight', function( e ) {
				jQuery('a.nivo-prevNav').trigger('click');
				e.stopImmediatePropagation();
				return false; } );
		}\n";
*/
		// Nivo Javascript arguments
		$output .= "\n    jQuery('div#" . $htmlID . "').nivoSlider(";

		if ( count( $javascriptArgs ) > 0 ) {
			$output .= "{\n      " . implode( ",\n      ", $javascriptArgs ) . "\n    }";
		}
		$output .= ");";

		if ( $hasControlNav && $hasThumbs ) {
			// Make thumbnails visisble
			$output .= "\n    jQuery('div.nivo-controlNav').css('visibility', 'visible');";
		}

		$output .= "\n  });";
		$output .= "\n</script>\n";

		echo $output;
	}

	private function get_val( $instance, $key, $default = '', $escape = true ) {
		$val = '';

		if ( isset( $instance[ $key ] ) ) {
			$val = trim( $instance[ $key ] );
		}

		if ( $val == '' ) {
			$val = $default;
		}

		if ( $escape ) {
			$val = esc_attr( $val );
		}

		return $val;
	}

	private function get_val_numeric( $instance, $key, $default = '' ) {
		$val = $this->get_val( $instance, $key, $default, false );

		if ( !is_numeric( $val ) ) {
			return '';
		}

		return $val;
	}

	public function update( $new_instance, $old_instance ) {
		$new_instance[ 'title' ] = esc_attr( $new_instance[ 'title' ] );
		return $new_instance;
	}

	private function create_radio($id, $setting, $title, $description = false, $options = array("default", "true", "false")) {
		$output = '';
		$output .= "<p>\n";
		$output .= "<label><strong>" . $title . ":</strong></label><br />\n";
		if ($description) { $output .= "<small>" . $description . "</small><br />\n"; }

		foreach ($options as $type) {
			$output .= '<input type="radio" ';
			$output .= 'id="' . $this->get_field_id( $id ) . '-' . $type . '" ';
			$output .= 'name="' . $this->get_field_name( $id ) . '" ';
			$output .= 'value="' . $type . '"';
			$output .= 'style="vertical-align: middle;"';
			if ( ($type == 'default' && $setting == '') || $setting == $type ) {
				$output .= ' checked="checked"';
			}
			$output .= "/>\n";
			// Label
			$output .= '<label for="' . $this->get_field_id( $id ) . '-' . $type . '" style="vertical-align: middle;"> ' . ucfirst($type) . "</label>\n";

		}
		$output .= "</p>\n";
		echo $output;
	}

	private function create_field($id, $setting, $title, $description = false, $class = 'widefat') {
		$output = '';
		$output .= "<p>\n";
		$output .= '<label for="'. $this->get_field_id( $id ) . '"><strong>' . $title . ":</strong></label><br />\n";
		if ($description) { $output .= "<small>" . $description . "</small><br />\n"; }
		$output .= '<input type="text" ';
		$output .= 'id="' . $this->get_field_id( $id ) . '" ';
		$output .= 'name="' . $this->get_field_name( $id ) . '" ';
		$output .= 'value="' . $setting . '" ';
		$output .= 'class="' . $class . '"';
		$output .= "/>\n</p>\n";
		echo $output;
	}

	private function create_select($id, $setting, $title, $description = false, $options) {
		$output = '';
		$output .= "<p>\n";
		$output .= '<label for="' . $this->get_field_id( $id ) . '"><strong>' . $title . ":</strong></label><br />\n";
		if ($description) { $output .= "<small>" . $description . "</small><br />\n"; }
		$output .= '<select id="' . $this->get_field_id( $id ) . '" ';
		$output .= 'name="' . $this->get_field_name( $id ) . '" ';
		$output .= "class=\"widefat\">\n";
		foreach ($options as $key => $value) {
			$output .= '<option value="' . $key . '"';
			if ($setting == $key) { $output .= ' selected="selected"'; }
			$output .= '>' . $value . "</option>\n";
		}
		$output .= "</select>\n</p>\n";
		echo $output;
	}

	private function create_checkbox($id, $setting, $title) {
		$output = '';
		$output .= "<p>\n";
		$output .= '<input type="checkbox" ';
		$output .= 'id="' . $this->get_field_id( $id ) . '" ';
		$output .= 'style="vertical-align: middle;" ';
		$output .= 'name="' . $this->get_field_name( $id ) . '" ';
		$output .= 'value="' . $id . '"';
		if ($setting) { $output .= ' checked="checked"'; }
		$output .= "/>\n";

		$output .= '<label for="'. $this->get_field_id( $id ) . '" ';
		$output .= 'style="vertical-align: middle;">';
		$output .= '<strong>' . $title . "</strong></label><br />\n";
		$output .= "</p>\n";
		echo $output;
	}

	public function form( $instance ) {
		global $wpdb;
		$instance = wp_parse_args(
				(array) $instance,
				array(
						'title' => '',
						'html_id' => 'slider',
						'width' => '',
						'height' => '',
						'resizewidth' => '',
						'resizeheight' => '',
						'resizebg' => '',
						'resize' => '',
						'order' => 'random',
						'tags' => '',
						'shuffle' => 'false',
						'max_pictures' => '',
						'center' => '',
						'gallery' => '',
						'caption' => '',
						'htmlcaption' => '',
						'theme' => '',
						// nivo settings
						'effect' => '',
						'slices' => '',
						'boxcols' => '',
						'boxrows' => '',
						'animspeed' => '',
						'pausetime' => '',
						'startslide' => '',
						'directionnav' => '',
						'controlnav' => '',
						'controlnavthumbs' => '',
						'thumbswidth' => '',
						'thumbsheight' => '',
						'thumbscontainerheight' => '',
						'thumbsgap' => '',
						'controlnavthumbsfromrel' => '',
						'controlnavthumbssearch' => '',
						'controlnavthumbsreplace' => '',
						'keyboardnav' => '',
						'pauseonhover' => '',
						'manualadvance' => '',
						'captionopacity' => '',
						'beforechange' => '',
						'afterchange' => '',
						'slideshowend' => '',
						'lastslide' => '',
						'afterload' => '' ) );

		$order_values = array(
				'random' => 'Random',
				'asc' => 'Latest First',
				'desc' => 'Oldest First',
				'sortorder' => 'NextGen Sortorder' );
		$galleries = $wpdb->get_results( "SELECT * FROM $wpdb->nggallery ORDER BY name ASC" );

		// Start HTML Page
		$this->create_field('title', $instance['title'], 'Widget title'); ?>
		<p>
			<label><strong>Select a gallery to use:</strong></label><br />

			<?php
			if ( is_array( $galleries ) && count( $galleries ) > 0 ) {

				echo '<select id="';
				echo $this->get_field_id( 'gallery' ) . '" name="';
				echo $this ->get_field_name( 'gallery' );
				echo '" class="widefat">';
				echo '<option value="">All images</option>';

				$gallery_selected = '';

				foreach ( $galleries as $gallery ) {
					if ( $gallery->gid == $instance[ 'gallery' ] ) {
						$gallery_selected = " selected=\"selected\"";
					} else {
						$gallery_selected = "";
					}
					echo "<option value=\"" . $gallery->gid . "\"" . $gallery_selected . ">" . $gallery->name . "</option>";
				}

				echo '</select>';
			} else {
				echo 'No galleries found';
			}
		?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'order' ); ?>"><strong>Order:</strong></label><br />
			<select id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' );?>" class="widefat">
			<?php
				$order_selected = '';
				foreach ( $order_values as $key => $value ) {
					if ( $key == $instance[ 'order' ] ) {
						$order_selected = " selected=\"selected\"";
					} else {
						$order_selected = "";
					}
					echo "<option value=\"" . $key . "\"" . $order_selected . ">" . $value . "</option>";
				}
			?>
			</select>
		</p>
		<?php
		$this->create_field('tags', $instance['tags'], 'Only display images tagged as', '(Comma seperated list)');
		$this->create_radio('shuffle', $instance['shuffle'], 'Shuffle', '(Only for random order)', array("true", "false"));
		$this->create_field('max_pictures', $instance['max_pictures'], 'Max pictures', '(Leave blank for all)');
		$this->create_field('html_id', $instance['html_id'], 'HTML id');
		$this->create_field('width', $instance['width'], 'Width', '(Leave blank for auto)');
		$this->create_field('height', $instance['height'], 'Height', '(Leave blank for auto)');
		$this->create_select('caption', $instance['caption'], 'Caption', false,
				array( '0' => 'Disabled',
						'alttext' => 'Alt text',
						'description' => 'Description',
						'both' => 'Both (Alt text - Description)',
						'html' => 'Use a HTML caption'));
		$this->create_field('htmlcaption', $instance['htmlcaption'], 'HTML Caption', '(HTML formatted caption that will display on every image)');
		$this->create_select('resize', $instance['resize'], 'Resize', '(Resize images using TimThumb v2)',
				array( '0' => 'Disabled',
						'1' => 'Resize to fit (no cropping)',
						'2' => 'Crop and resize to best fit the dimensions',
						'3' => 'Resize proportionally and add borders',
						'4' => 'Resize proportionally with no gaps'));
		$this->create_field('resizebg', $instance['resizebg'], 'Resize BG Color', '(Color in HEX format - eg. #rrggbb. Leave blank for white)');
		$this->create_field('resizewidth', $instance['resizewidth'], 'Resize width', '(Leave blank for auto)');
		$this->create_field('resizeheight', $instance['resizeheight'], 'Resize height', '(Leave blank for auto)');
		$this->create_checkbox('center', $instance['center'], 'Center content');
		?>

		<div class="javascript_settings" style="display: none; border: 1px solid #cccccc; background-color: #f0f0f0;">
			<div style="padding: 10px;">
				<p><a href="http://nivo.dev7studios.com/#usage" target="jj_nextgen_jquery">Visit Nivo configuration page</a></p>
				<p>Leave blank to use defaults.</p>
				<?php
				$this->create_field('effect', $instance['effect'], 'Effects', '(comma seperated sets or leave blank for random)');
				$this->create_field('slices', $instance['slices'], 'Slices');
				$this->create_field('boxcols', $instance['boxcols'], 'Box Columns');
				$this->create_field('boxrows', $instance['boxrows'], 'Box Rows');
				$this->create_field('animspeed', $instance['animspeed'], 'Animation speed');
				$this->create_field('pausetime', $instance['pausetime'], 'Pause time');
				$this->create_field('startslide', $instance['startslide'], 'Start slide');
				$this->create_radio('directionnav', $instance['directionnav'], 'Direction Navigation');
				$this->create_radio('controlnav', $instance['controlnav'], 'Control Navigation');
				$this->create_radio('controlnavthumbs', $instance['controlnavthumbs'], 'Thumbnail Navigation');
				$this->create_field('thumbswidth', $instance['thumbswidth'], 'Thumbnail width');
				$this->create_field('thumbsheight', $instance['thumbsheight'], 'Thumbnail height');
				$this->create_field('thumbscontainerheight', $instance['thumbscontainerheight'], 'Thumbnail container height', '(eg, image rows x thumb height)');
				$this->create_field('thumbsgap', $instance['thumbsgap'], 'Thumbnail gap');
				$this->create_radio('keyboardnav', $instance['keyboardnav'], 'Keyboard navigation');
				$this->create_radio('pauseonhover', $instance['pauseonhover'], 'Pause on hover');
				$this->create_radio('manualadvance', $instance['manualadvance'], 'Manual advance');
				$this->create_field('captionopacity', $instance['captionopacity'], 'Caption opacity');
				$this->create_field('beforechange', $instance['beforechange'], 'Before change');
				$this->create_field('afterchange', $instance['afterchange'], 'After change');
				$this->create_field('slideshowend', $instance['slideshowend'], 'Slideshow end');
				$this->create_field('lastslide', $instance['lastslide'], 'Last slide');
				$this->create_field('afterload', $instance['afterload'], 'After load');
				?>
			</div>
		</div>
		<p><a href="#" onclick="jQuery(this).parent().prev('div.javascript_settings').toggle();return false;">Nivo Slider Settings</a></p>
		<?php
	}
}
