<?php
/*
*
* WRANGLER SECTION BUILDER CLASS V1.00
* Author: Ismael Rivera
* website: awesomeblogger.com
* email: coralblue79@gmail.com 
*
*--------------------------------------------------------------------------
*
* Very basic class I created for generic wordpress theme that controls  
* the output for the sections on a template making them extremely customizable. 
* The class basically is composed of 2 main functions: sec_begin(), sec_finish().
* Includes pre-tags and commentary that can be customized to retrofit the output.
* 
*/
/*
	* name:string  = This would be the name you want to give to the section you're creating.
	* location:int = (values 1,2 or 3) In the event that the developer wishes to specify 
	*                the location on the page where the section is being created as either 
					 part of the header(1), the content(2) or the footer(3).
	  section_grid:bool  = Basically, Are you going to use a grid?
	  spacer_content = If you want to create a spacer div between sections, just add some 
	  				   content to this index or leave it blank(not NULL which is different), 
					   but blank and a spacer div will be created on top of the created 
					   section. 			 
	* grouping:int = Unlike location which is a sort of grouping, this is more like a 
					 categorization of sections under a specific subject. This can be used for
					 a number of applications including plugin development, auto-sorting, tagging
					 etc, etc.
	* spacer_classes = I know I wrote this index option for a reason. Right now I have no 
					   recollection of it's purpose.
	* content_wrapper_classes = ditto. Still working this out.
	*/
	
class Section_Builder{
	
	public static $name;
	public static $section;
	public static $options;
	
	/*
	Call this way:
	Section_Builder::sec_Begins($args);
	*/
	
	public static function sec_Begins($options = array( 'name' => NULL, 
														'location' => NULL, 
														'section_grid' => true, 
														'spacer_content' => NULL, 
														'grouping' => NULL, 
														'spacer_classes' => array(), 
														'content_wrapper_classes' => array()
														)
									  )
	{
	
	
		
	self::$name = $options['name'];
	self::$options = $options;
		
	if (isset($options['section_grouping'])){	
	$in  ='<!--====BEGIN/SECTION '.strtoupper($options['section_grouping']).'/HERE====-->'."\n";
	} else {
	$in  ='<!--==================================================';
	$in .='BEGIN/SECTION/HERE';
	$in .='==================================================-->'."\n";	
	}
	$in .='<!--Cogratulations: You have just constructed a section for this homepage-->'."\n";
	$in .='<!--SECTION '.strtoupper($options['name']).' HAS NOW BEEN CREATED-->'."\n";
	$in .= '<span id="stopper_'.$options['name'].'" class="easing_stopper"></span>'."\n";
	if(isset($options['spacer_content'])){
	    $in .= '<div id="spacer_content_wrapper_'.$options['name'].'" class="wrapper">'. $options['spacer_content'] .'</div>';
	} else {
	    $in .= '<div id="spacer_wrapper_'.$options['name'].'" class="wrapper';
		if(isset($options['spacer_classes'])){
			if (is_array($options['spacer_classes'])){
				foreach ($options['spacer_classes'] as $spacer_class){
					$in .= ' '. $spacer_class;
					} 
				} else {
					$in .= ' '. $options['spacer_classes'];
					}
		}
	    $in .= '"></div>'."\n";
	}
	$in .= '<div id="content_wrapper_'.$options['name'].'" class="wrapper';
	
	if(isset($section)){
		if (is_int($section)){
		  if($section <= 3){
			  if($section === 1){
				  $section_class = "header_section global_section";
			  }	else if($section === 2){
				  $section_class = "content_section";
			  } else if($section === 3){
				  $section_class = "footer_section global_section";
			  }
		   $in .= ' '. $section_class;  
		   } 
		} 
	}
	
	if(isset($options['content_wrapper_classes'])){
	if ($options['content_wrapper_classes'] !== NULL){
		if (is_array($options['content_wrapper_classes'])){
			foreach ($options['content_wrapper_classes'] as $content_wrapper_class){
				$in .= ' '. $content_wrapper_class;
				} 
			} else {
				$in .= ' '. $options['content_wrapper_class'];
				}
		}
	}
	
	$in .= '">'."\n";
	if ($options['section_grid'] == true){

	$in .= '<div id="section_'.$options['name'].'" >'."\n\n";	
		} else {
	$in .= '<div id="section_'.$options['name'].'" class="grid">'."\n\n";
		}
	$in .= '<!--######### Section Content BEGIN #########-->'."\n\n";
	
	echo $in;
	
	} 
	
	
	//End sec_begin() function
	
	
	public static function sec_Ends($options = NULL){
	$out  = "\n\n".'<!--######### Section Content END #########-->'."\n\n";
	$out .= '</div><!--section_'.self::$name.'-->'."\n";	
	$out .= '</div><!--content_wrapper_'.self::$name.'-->'."\n";
	$out .= '<div id="spacer_wrapper_bot_'.self::$name.'" class="wrapper';
	
	if ($options != NULL){
	  if (array_key_exists('spacer_wrapper_bot_classes', $options)){
		if (is_array($options['spacer_wrapper_bot_classes'])){
			foreach ($options['spacer_wrapper_bot_classes'] as $spacer_wrapper_bot_class){
				$out .= ' '. $spacer_wrapper_bot_class;
			} 
		} else {
		  	$out .= ' '. $options['spacer_wrapper_bot_classes'];
		}
	  }
	}
	$out .= '"></div>'."\n";
	if (isset(self::$options['section_grouping'])){	
	$out .='<!--I THINK SECTION '.strtoupper(self::$options['section_grouping']).' ( '.strtoupper(self::$name).' ) ENDS HERE-->'."\n";
	} else {
	$out .='<!--I THINK '.strtoupper(self::$name).' SECTION ENDS HERE-->'."\n";	
	}
	
	$out .='<!--=====================================================================================================-->'."\n";
	echo $out;
	}
	
		
}