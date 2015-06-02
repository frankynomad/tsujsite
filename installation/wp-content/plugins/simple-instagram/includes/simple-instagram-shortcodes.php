<?php
require_once('instagram.class.php');

function si_feed( $atts ) {
    extract( shortcode_atts( array(
		'limit' => 10,
		'img_size' => 'full',
		'vid_size' => 'small',
		'wrapper' => 'div',
		'link' => 'true',
		'width' => 'auto',
		'tag' => '',
		'user' => 'self'
    ), $atts ) );
     
    $instagram = _createInstagram();

     
	if($tag == ''){
     	$feed = $instagram->getUserMedia($user, $limit);
	}else{
     	$feed = $instagram->getTagMedia($tag, $limit);
	}
	if(($feed) && count($feed->data) > 0){
	 	if(count($feed->data) > $limit){
	 		$total = count($feed->data);
	 		$diff = $total - $limit;
			$start = $total - $diff;
			for($i=$start; $i <= $total; $i++){	
				unset($feed->data[$i]);
			}
	 	}
     
		$width = str_replace('px', '', $width);
		 
		if($width != 'auto'){
			if($width > 612){
		     $width = 612;
		   	}
		   	$w_param = 'width="'.$width.'" height="'.$width.'"';
		}else{
		   	$w_param = '';
		}
		 
		if($wrapper == 'li'){
		   	$return .= '<ul class="si_feed_list">';
		}

		// else {
		// 	$return .= '<p class="console">'.json_encode($instagram->getUserMedia($user, $limit)).'</p>';
		// }

		foreach($feed->data as $media){
		   
			$likes = $media->likes->count;
			$caption = $media->caption->text;
			$profileUrl = $media->user->username;
			$rawDate = $media->created_time;

			$date = date( 'h:i A M d', $rawDate );

			$fontSize = ''; 
		   	
		   	if( strlen($caption) > 300 ) {
		   		$fontSize = 'style="font-size: 0.8em"';
		   	} else {
		   		$fontSize = '';
		   	}
		   	
	    	$return .= '<div class="masonryItem si_item">';
	    	$return .= '<div class="intent_wrap clearfix">
	    					<p><a href="'.$media->link.'" target="_blank">
	    						<i class="fa">&#xf004;</i><span>'.$likes.'</span>
	    					</a></p>';
	    	$return .= '</div>';
	    		$return .= '<div class="meta_trigger">&#xf106;</div>';
	    		$return .= '<div class="social_options clearfix">';
	    			$return .= '<div class="intents clearfix">';
	    				
	    				$return .= '<h2><a href="https://instagram.com/'.$profileUrl.'" target="_blank"><i class="fa">&#xf16d;</i></a></h2>';
	    				if($caption == true) {
				    		$return .= '<div class="date">'.$date.'</div>';
				    		$return .= '<h3 class="main_text" '.$fontSize.'>'.$caption.'</h3>';
				    	}else{
				    		$return .= '<h3><a href="https://instagram.com/'.$profileUrl.'" target="_blank">
			    							'.$profileUrl.'
			    						</a></h3>';
				    	}
				    	
			    		
		   
		   	if($media->videos == true){ // if VIDEOS
				switch($vid_size){
			     	case 'full':
			      		$path = $media->videos->standard_resolution;
			      		$url = $path->url;
			       		break;
			       	case 'medium':
			      		$path = $media->videos->standard_resolution->url;
			      		$url = $path->url;
			       		break;
			     	case 'small':
			       		$path = $media->videos->low_bandwidth;
			       		$url = $path->url;
			       		break;
			   	}
			   	// Meta Items
			  
		   			$return .= '</div>'; // Close Intents
		   		$return .= '</div>'; // Close Options

			   	$url = str_replace('http://', '//', $url);
			   
			   	$return .= '<video>';
					$return .= '<source src="'.$url.'" type="video/mp4">';
					$return .= 'Your browser does not support the video tag.';
				$return .= '</video>';
			   	$return .= '<div class="play fa">&#xf04b;</div>'; //Play Button
			}else {
				switch($img_size){
			    	case 'full':
			       		$url = $media->images->standard_resolution->url;
			       		break;
			     	case 'medium':
			      		$url = $media->images->low_resolution->url;
			       		break;
			     	case 'small':
			       		$url = $media->images->thumbnail->url;
			       		break;
			   	}

			   	// Meta Items
			   
		   		$return .= '</div>'; // Close Intents
		   		$return .= '</div>'; // Close Options


			   	$url = str_replace('http://', '//', $url);
			   	if($link == 'true'){
			     	$return .= '<a href="'.$media->link.'" target="_blank">';
			   	}
			  	
			   	$return .= '<img src="'.$url.'" '.$w_param.' >';
			   	if($link == 'true'){
			    	$return .= '</a>';
			   	}
			}
		   
		    $return .= '</div>'; // Close MasonryItem

		}
		 
	}else{
		$return = '';
	}

	return $return;
}
  
add_shortcode( 'si_feed', 'si_feed');



function _createInstagram(){
	$options = get_option('si_options');
	$auth = get_option('si_oauth');

	$config = array(
	      'apiKey'      => $options['instagram_app_id'],
	      'apiSecret'   => $options['instagram_app_secret'],
	      'apiCallback' => site_url() . '/wp-admin/admin-ajax.php?action=register_instagram'
	    );

	$instagram = new Instagram($config);
	$instagram->setAccessToken($auth);

	return $instagram;
}
  
?>
