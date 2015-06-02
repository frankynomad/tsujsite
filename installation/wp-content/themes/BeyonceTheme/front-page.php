<?php get_header() ?>
<main class="clearfix">
	<section id="hero">
		<h1>Chris Tsujiuchi</h1>
		<h2>A Very Chris-terical Website</h2>
		<video autoplay loop class="underlay">
			<source src="<?php bloginfo('template_directory') ?>/video/TsujHeaderVid.webm" type="video/webm">
			<source src="<?php bloginfo('template_directory') ?>/video/TsujHeaderVid.mp4" type="video/mp4">
		</video>
	</section>
	<section id="content">

		<div class="masonryItem me w2"></div>

		<?php
			$username = 'ChrisTsujiuchi';
			$tweets = getTweets(10, $username);

			foreach($tweets as $tweet){
				
				if($tweet['text']){
			        $the_tweet = $tweet['text'];
			       
			        if(is_array($tweet['entities']['user_mentions'])){
			            foreach($tweet['entities']['user_mentions'] as $key => $user_mention){
			                $the_tweet = preg_replace(
			                    '/@'.$user_mention['screen_name'].'/i',
			                    '<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>',
			                    $the_tweet);
			            }
			        }

			        if(is_array($tweet['entities']['hashtags'])){
			            foreach($tweet['entities']['hashtags'] as $key => $hashtag){
			                $the_tweet = preg_replace(
			                    '/#'.$hashtag['text'].'/i',
			                    '<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&src=hash" target="_blank">#'.$hashtag['text'].'</a>',
			                    $the_tweet);
			            }
			        }

			        if(is_array($tweet['entities']['urls'])){
			            foreach($tweet['entities']['urls'] as $key => $link){
			                $the_tweet = preg_replace(
			                    '`'.$link['url'].'`',
			                    '<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>',
			                    $the_tweet);
			            }
			        }

			        echo '
					<div class="masonryItem tweet">
						<div class="meta_trigger">&#xf106;</div>
					';

			        echo '
				        <div class="social_options clearfix">
				        	
				        	<div class="intents clearfix">
				        		<h2><a href="http://twitter.com/'.$username.'"><i class="fa fa-twitter"></i><br>@'.$username.'</a></h2>
					            <p>
					            	<a class="reply" href="https://twitter.com/intent/tweet?in_reply_to='.$tweet['id_str'].'">
					            		&#xf112;
					            		<span>Reply</span>
					            	</a>
					            </p>
					            <p>
					            	<a class="retweet" href="https://twitter.com/intent/retweet?tweet_id='.$tweet['id_str'].'">
					            		&#xf079;
					            		<span>Retweet</span>
					            	</a>
					            </p>
					            <p>
					            	<a class="favorite" href="https://twitter.com/intent/favorite?tweet_id='.$tweet['id_str'].'">
					            		&#xf005;
					            		<span>Favorite</span>
					            	</a>
					            </p>
					        </div>
				        </div>
				        <div class="content">
					        <span class="date">
					            <a href="https://twitter.com/'.$username.'/status/'.$tweet['id_str'].'" target="_blank">
					                '.date('h:i A M d',strtotime($tweet['created_at']. '- 8 hours')).'
					            </a>
				        	</span>
					   		<h3 class="main_text">'.$the_tweet.'</h3>
				   		</div>
				    </div>';

			    } else {
			        echo '
			        <br /><br />
			        <a href="http://twitter.com/'.$username.'" target="_blank">Click here to read YOURUSERNAME\'S Twitter feed</a>';
			    }
			}
		?>
		<?php echo do_shortcode('[si_feed img_size="full" vid_size="small"]');?>
		<div class="gutter-sizer"></div>
	</section>
	
</main>

<?php get_sidebar() ?>
<?php get_footer() ?>
