<?php 

    $sosimple_options = get_option( 'sosimple_option_name' ); // Array of All Options
    $button_background_color_5 = $sosimple_options['button_background_color_5']; // Button Background Color
	$button_text_color_6 = $sosimple_options['button_text_color_6']; // Button Text Color
	$read_more_type_1 = $sosimple_options['read_more_type_1']; // Read More Type
    
 ?>
 <style>
	
	<?php if ($button_text_color_6){ ?>
	.more-link span{
		color: <?php echo $button_text_color_6; ?>
	} <?php } ?>

	<?php if (($read_more_type_1 == 'Option-third') || ($read_more_type_1 == 'Option-fourth')){ ?>
	.more-link{
		margin-top: 40px;
    	display: block;
	} <?php } ?>

	.ss_rounded{
		border-radius: 5px;
	}

	.ss_squared {
	 	border-radius: 0;
	}

	.ss_fill{
		background-color: <?php echo $button_background_color_5; ?>
	}

	.ss_button{
		padding: 5px 10px;
	}

	.ss_icon:after{
		font-family: 'Genericons';
		font-size: 140%;
	    font-weight: normal;
	    font-style: normal;
	    line-height: 1;
	    vertical-align: bottom;
	    text-decoration: none;
	    -webkit-font-smoothing: antialiased;
	}

	.ss_icon_arrow:after{
		content: '\f429';
	}

	.ss_icon_arrow2:after{
		content: '\f452';
	}

	.ss_icon_check:after{
		content: '\f418';
	}

 </style>

 <?php 

?>